<?php

namespace App\Http\Controllers\ClubDashboard;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Order;
use App\Models\TypeCategory;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function booking(Request $request)
    {
        // جلب جميع الفئات لعرضها في خيارات الفلترة
        $bookingsQuery = Booking::where("is_active",true)->where("club_id",auth("club")->id());
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
        return view('club-dashboard.reports.booking', compact( 'data'));
    }

    public function show_book($id)
    {
        $booking = Booking::with(['club', 'user', 'category', 'type_category'])->findOrFail($id);
        return view('club-dashboard.reports.show_book', compact('booking'));
    }

    public function places()
    {

        // Get top places by booking count
        $topPlaces = \DB::table('bookings')
        ->where("club_id", auth("club")->id())
        ->select('type_category_id', \DB::raw('count(*) as total'))
        ->groupBy('type_category_id')
        ->orderByDesc('total')
        ->get();

        // Get the place details
        $topPlaces = $topPlaces->map(function ($booking) {
            $place = TypeCategory::find($booking->type_category_id);
            return [
                'name' => $place->name,
                'category' => $place->category->name,
                'total' => $booking->total,
            ];
        });
        return view('club-dashboard.reports.places', compact('topPlaces'));
    }




}
