<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function booking(Request $request)
    {
        // جلب جميع الفئات لعرضها في خيارات الفلترة
        $bookingsQuery = Booking::where("is_active",true);
        // $categories = auth("club")->user()->categories;

        // جلب جميع الحجوزات مع معلومات النادي، المستخدم، والفئة المرتبطة

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
        return view('dashboard.reports.booking', compact( 'data'));
    }

    public function show_book($id)
    {
        $booking = Booking::with(['club', 'user', 'category', 'type_category'])->findOrFail($id);
        return view('dashboard.reports.show_book', compact('booking'));
    }

    public function order(Request $request)
    {
        $date = $request->input('date');

        $query = Order::query();

        if ($date) {
            $query->whereDate('created_at', $date);
        }

        $orders = $query->get();
        return view('dashboard.reports.order', compact('orders'));
    }

    public function orderFilter(Request $request)
{
    $date = $request->input('date');

    // Assuming you have an Order model and it has a 'created_at' field
    $orders = Order::with("user","items")->whereDate('created_at', $date)->get();

    return response()->json([
        'data' => $orders
    ]);
}

}
