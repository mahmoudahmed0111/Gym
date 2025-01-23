<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Club;
use App\Models\Booking;
use App\Models\Setting;
use App\Models\Category;
use App\Models\PromoCode;
use App\Models\PaymentLog;
use App\Models\ClubCategory;
use App\Models\TypeCategory;
use Illuminate\Http\Request;
use App\Services\PaymobServise;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClubResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\BookingResource;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ClubBookingController extends Controller
{

    public function user_booking(Request $request)
    {
        // جلب جميع الفئات لعرضها في خيارات الفلترة
        $bookings = auth()->user()->bookings;
        return response()->json(['bookings' => BookingResource::collection($bookings)]);
    }

    public function generateTimeSlots(Request $request)
    {
        $request->validate([
            'club_id' => 'required|exists:clubs,id',
            'category_id' => 'required|exists:categories,id',
            'type_category_id' => 'required|exists:type_categories,id',
            'booking_date' => 'required|date',
        ]);

        $clubId = $request->club_id;
        $categoryId = $request->category_id;
        $typeCategoryId = $request->type_category_id;
        $bookingDate = $request->booking_date;

        // Fetch club and type category details
        $club = Club::findOrFail($clubId);
        $typeCategory = TypeCategory::findOrFail($typeCategoryId);

        // Initialize start and end times from club details
        $startTime = Carbon::createFromFormat('H:i:s', $club->start_time);
        $endTime = Carbon::createFromFormat('H:i:s', $club->end_time);

        // Initialize slots array to store available time slots
        $slots = [];
        $slotDuration = ClubCategory::where("category_id", $categoryId)->where("club_id", $clubId)->first()->duration; // Slot duration in minutes

        // Loop through time slots between club's start and end time
        while ($startTime->lt($endTime)) {
            $slotEndTime = (clone $startTime)->addMinutes($slotDuration);

            // Check if the slot is already booked
            $isBooked = Booking::where('club_id', $clubId)
                ->where('booking_date', $bookingDate)
                ->where('category_id', $categoryId)
                ->where('type_category_id', $typeCategoryId)
                ->where(function ($query) use ($startTime, $slotEndTime) {
                    $query->where(function ($q) use ($startTime, $slotEndTime) {
                        $q->where('start_time', '<', $slotEndTime)
                            ->where('end_time', '>', $startTime);
                    });
                })
                ->count();

            // If slot is not fully booked, add to available slots
            if ($isBooked < $typeCategory->number) {
                $slots[] = [
                    'start_time' => $startTime->format('H:i:s'),
                    'end_time' => $slotEndTime->format('H:i:s'),
                ];
            }

            // Move to the next slot
            $startTime->addMinutes($slotDuration);
        }

        return response()->json($slots);
    }



    public function category()
    {
        $category = Category::all();
        $category = $category->map(function ($item) {
            return [
                "id" => $item->id,
                "name" => $item->name,
                "desc" => $item->desc,
                "image" => url("storage/" . $item->image),
            ];
        });
        return sendResponse(200, "successfull", $category);
    }

    public function category_club($categoryId)
    {
        // Ensure the user is authenticated
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized: User not authenticated'
            ], 401);
        }

        // Get clubs that match the user's city and the given category ID
        $clubs = Club::where('city_id', $user->city_id)
            ->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->get();

        // Format the club data
        $clubs = $clubs->map(function ($item) {
            return [
                "id" => $item->id,
                "name" => $item->name,
                "desc" => $item->desc,
                "image" => url("storage/" . $item->image),
            ];
        });

        // Return the response
        return response()->json([
            'status' => 200,
            'message' => 'successfull',
            'clubs' => $clubs
        ]);
    }


    public function category_type($clubId, $category)
    {
        $club = TypeCategory::where("category_id", $category)->where("club_id", $clubId)->get();
        $TypeCategory = $club->map(function ($item) {
            return [
                "id" => $item->id,
                "name" => $item->name,
                'number' => $item->number,
                'price' => $item->price,
            ];
        });
        return sendResponse(200, "successfull", $TypeCategory);
    }


    public function bookTimeSlot(Request $request, $clubId)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'type_category_id' => 'required|exists:type_categories,id',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
            'booking_date' => 'required|date',
            'promo_code' => 'nullable|',
        ]);

        $typeCategoryId = $request->type_category_id;
        $bookingDate = $request->booking_date;
        $startTime = $request->start_time;
        $endTime = $request->end_time;

        // Check availability of type category for booking
        $typeCategory = TypeCategory::findOrFail($typeCategoryId);

        // Check if the time slot is already booked
        $isBooked = Booking::where('club_id', $clubId)
            ->where('booking_date', $bookingDate)
            ->where('is_active', true)
            ->where('category_id', $request->category_id)
            ->where('type_category_id', $typeCategoryId)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime]);
            })
            ->count();
        $club = Club::find($clubId);
        if (!$club->isBookingTimeValid($startTime, $endTime)) {
            return response()->json(['message' => 'the club is closed.'], 400);
        }


        if ($isBooked >= $typeCategory->number) {
            return response()->json(['message' => 'This time slot is already booked.'], 409);
        }
        $startTime = Carbon::parse($request->start_time);
        $endTime = Carbon::parse($request->end_time);
        // Calculate the difference in hours
        $hours = $startTime->diffInHours($endTime);

        // Create booking
        $booking = Booking::create([
            'club_id' => $clubId,
            'user_id' => auth()->user()->id,
            'price' => $hours * $typeCategory->price,
            'type_category_id' => $typeCategoryId,
            'category_id' => $request->category_id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'is_active' => false,
            'booking_date' => $bookingDate,
        ]);
        if ($request->has('promo_code')) {
            $promoCode = PromoCode::where('code', $request->input('promo_code'))->first(); // Assuming $promoCodeInput is the promo code entered by the user
            if ($promoCode) {
                $discountApplied = $booking->applyPromoCode($promoCode);

                if ($discountApplied) {
                    // return $discountApplied;
                    $booking->save();
                    return booking($clubId, 'booking', $booking->price, "visa", $booking->id);

                    // return response()->json(['message' => 'Promo code applied successfully!', 'booking' => $booking], 200);
                } else {
                    // return $discountApplied;

                    return response()->json(['message' => 'Promo code is not applicable or invalid!1'], 400);
                }
            } else {
                return response()->json(['message' => 'Promo code is not applicable or invalid!2'], 400);
            }
        }
        // Decrease the available count of type category
        return booking($clubId, 'booking', $hours * $typeCategory->price, "visa", $booking->id);
    }


    public function handlePayment(Request $request)
    {
        $request->validate([
            'paymentLog_id' => 'required|exists:payment_logs,id',
            'booking_id' => 'required|exists:bookings,id',
            'payment_status' => 'required|in:success,failure',
        ]);
        $paymentLog_id = $request->paymentLog_id;
        $payment_status = $request->payment_status;
        $booking_id = $request->booking_id;

        if ($request->payment_status == 'success') {
            $paymentLog = PaymentLog::find($paymentLog_id);
            $paymentLog->update(['status' => true]);
            $owner = $paymentLog->owner;
            if ($owner->subscriptions->isNotEmpty()) {
                $owner->update([
                    "balance" => $owner->balance + $paymentLog->amount
                ]);
            } else {
                $tax = 1 - (Setting::first()->tax / 100);
                $owner->update([
                    "balance" => $owner->balance + ($paymentLog->amount * $tax)
                ]);
            }
            $booking_id = Booking::find($booking_id)->update(['is_active' => true]);

            $qrCode = QrCode::format('png')->size(200)->generate(Booking::find($booking_id)->code);

            // Determine the storage path to save the image
            $storagePath = storage_path('app/public/qr_codes'); // Customize the path as needed

            // Create the subdirectory (if it doesn't exist)
            if (!file_exists($storagePath)) {
                mkdir($storagePath, 0755, true);
            }

            // Generate a unique filename for the image
            $filename = uniqid() . '.png';

            // Save the image to the storage path
            file_put_contents($storagePath . '/' . $filename, $qrCode);

            // Save the image path in the database
            return response()->json([
                'message' => 'Payment successful. Subscription is now active.',
                "qr_code" => url('storage/qr_codes/' . $filename),
            ]);
        } else {

            $paymentLog = PaymentLog::find($paymentLog_id)->delete();
            $booking_id = Booking::find($booking_id)->delete();
            return response()->json(['message' => 'Payment failed. Subscription has been cancelled.']);
        }
    }

    public function validateQrCode(Request $request)
    {
        $qrCode = $request->input('qr_code');

        // Assuming the QR code contains the booking ID
        $booking = Booking::where('code', $qrCode)->first();

        if ($booking && $booking->status == "pending" && $this->isValidDate($booking->start_date, $booking->end_date)) {
            $booking->status = "active";
            $booking->save();

            return response()->json(['success' => true, 'message' => 'Booking activated successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid QR code']);
    }

    private function isValidDate($startDate, $endDate)
    {
        $now = now();
        return $now->between($startDate, $endDate);
    }


    public function refund(Request $request, $bookingId)
    {
        $validator = Validator::make($request->all(), [
            'reason' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $booking = Booking::find($bookingId);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        // Check if the booking is eligible for a refund (e.g., check booking status, dates, etc.)

        $refund = $booking->refund()->create([
            'user_id' => auth()->user()->id,
            'club_id' => $booking->club_id,
            'reason' => $request->reason,
        ]);


        return response()->json(['message' => 'Refund processed successfully', 'refund' => $refund], 201);
    }
    public function top_five_clubs()
    {
        // Ensure the user is authenticated
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized: User not authenticated'
            ], 401);
        }

        // Get top five clubs in the user's city, ordered by bookings count
        $clubs = Club::where('city_id', $user->city_id)
            ->withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'status' => 200,
            'message' => 'successfull',
            'clubs' => ClubResource::collection($clubs)
        ]);
    }
}
