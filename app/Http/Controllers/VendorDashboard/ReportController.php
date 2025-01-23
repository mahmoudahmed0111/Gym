<?php

namespace App\Http\Controllers\VendorDashboard;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Vendor;
use Illuminate\Http\Request;

class ReportController extends Controller
{


    public function order(Request $request)
    {
        $orders = OrderItems::where("owner_type",get_class(Vendor::first()))->where("owner_id",auth('vendor')->id())->latest()->get();
        return view('vendor-dashboard.reports.order', compact('orders'));
    }

    public function bestSales(Request $request)
    {
        $vendor = auth('vendor')->user();

        $orders = OrderItems::select('product_id', \DB::raw('SUM(quantity) as total_quantity'))
            ->where('owner_type', get_class($vendor))
            ->where('owner_id', $vendor->id)
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'desc')
            ->with('product') // Assuming you have a relationship defined in the OrderItems model
            ->get();
        return view('vendor-dashboard.reports.product', compact('orders'));
    }



}
