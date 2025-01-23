<?php

namespace App\Http\Controllers\ClubDashboard;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Club;
use App\Models\ClubCategory;
use App\Models\Refund;
use App\Models\TypeCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        // جلب جميع الفئات لعرضها في خيارات الفلترة
        $bookingsQuery = Booking::where("is_active",true)->where("club_id",auth("club")->id());
        $categories = auth("club")->user()->categories;

        // فلترة الحجوزات بناءً على الفئة المحددة إذا كانت موجودة في الطلب
        if ($request->has('category_id')) {
            $category_id = $request->category_id;
            $bookingsQuery->whereHas('club', function ($query) use ($category_id) {
                $query->whereHas('categories', function ($query) use ($category_id) {
                    $query->where('categories.id', $category_id);
                });
            });
        }

        // استرجاع البيانات المفلترة أو غير المفلترة
        $data = $bookingsQuery->latest()->get();

        // تمرير الفئات والحجوزات إلى العرض
        return view('club-dashboard.bookings.index', compact('categories', 'data'));
    }
    public function refunds(Request $request)
    {
        $data = Refund::where("club_id",auth("club")->id())->latest()->get();
        return view('club-dashboard.bookings.refunds', compact('data'));
    }

    public function available(Request $request)
    {

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'type_category_id' => 'required|exists:type_categories,id',
            'booking_date' => 'required|date',
        ]);
        $data=$request->all();
        $clubId = auth("club")->id();
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
        $slotDuration = ClubCategory::where("category_id",$categoryId)->where("club_id",$clubId)->first()->duration; // Slot duration in minutes

        // Loop through time slots between club's start and end time
        while ($startTime->lt($endTime)) {
            $slotEndTime = (clone $startTime)->addMinutes($slotDuration);

            // Check if the slot is already booked
            $isBooked = Booking::where('club_id', $clubId)
                ->where('booking_date', $bookingDate)
                ->where('category_id', $categoryId)
                ->where('is_active', true)
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

        return view('club-dashboard.bookings.show', compact('slots',"data",'typeCategory','slotDuration'));
    }
    public function show_book($id)
    {
        $booking = Booking::with(['club', 'user', 'category', 'type_category'])->findOrFail($id);
        return view('club-dashboard.bookings.show_book', compact('booking'));
    }

    public function create()
    {
        // $categories = Category::all();
        $categories = auth('club')->user()->categories;
        $typeCategories = TypeCategory::where("club_id",auth("club")->id())->get();

        return view('club-dashboard.bookings.create', compact('categories', 'typeCategories'));

    }


    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'type_category_id' => 'required|exists:type_categories,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'booking_date' => 'required|date',
        ]);

        $typeCategoryId = $request->type_category_id;
        $bookingDate = $request->booking_date;
        $startTime = $request->start_time;
        $endTime = $request->end_time;
        $clubId=auth("club")->id();
        // Check availability of type category for booking
        $typeCategory = TypeCategory::findOrFail($typeCategoryId);

        // Check if the time slot is already booked
        $isBooked = Booking::where("is_active",true)->where('club_id', $clubId)
            ->where('booking_date', $bookingDate)
            ->where('category_id', $request->category_id)
            ->where('type_category_id', $typeCategoryId)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime]);
            })
            ->count();
            if (!auth("club")->user()->isBookingTimeValid($startTime, $endTime)) {
                return redirect()->back()->with('error', __('the club is closed.'));
            }
        if ($isBooked >= $typeCategory->number) {
            return redirect()->back()->with('error', __('model.This time slot is already booked.'));
        }
        $startTime = Carbon::parse($request->start_time);
        $endTime = Carbon::parse($request->end_time);
        // Calculate the difference in hours
        $hours = $startTime->diffInHours($endTime);

        // Create booking
        $booking = Booking::create([
            'club_id' => $clubId,
            'price' => $hours*$typeCategory->price,
            'type_category_id' => $typeCategoryId,
            'category_id' => $request->category_id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'booking_date' => $bookingDate,
        ]);

        // Decrease the available count of type category

        return redirect(route('club.bookings.index'))->with('success', __('model.Booking created successfully.'));

    }


    public function destroy($id)
    {
        $club = Booking::find($id);
        $club->delete();
        return redirect(route('club.bookings.index'))->with('success', __('models.deleted_successfully'));

    }


    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        // return response()->json(['success' => true ,"ids"=> $ids]);
        foreach ($ids as $id) {
            $Booking = Booking::find($id);
            if ($Booking) {
                $Booking->delete();
            }
        }
        return response()->json(['success' => true]);
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Booking::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();
        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }

    public function refundStatus(Request $request, $id)
    {
        $order = Refund::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();
        return redirect()->back()->with('success', 'Refund status updated successfully.');
    }


}
