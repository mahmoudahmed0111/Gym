<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Club;
use App\Models\User;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\Booking;
use App\Models\Product;
use App\Models\Trainee;
use App\Models\Vitamin;
use App\Models\PaymentLog;
use Illuminate\Http\Request;
use App\Models\Coaching\Coach;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function dashboard()
    {
        $statistics = [
            'admins' => Admin::count(),
            'users' => Trainee::count(),
            // 'vendors' => Vendor::count(),
            'coaches' => Coach::count(),
            'vitamens' => Vitamin::count(), // Assuming you have a rating field
            'orders' => Order::count(),
        ];
        $paymentLogs = PaymentLog::latest()->take(5)->get();
        $percentageChange = $this->calculatePercentageChange();
        $totalBalance = PaymentLog::sum('amount');
        $incomeData = $this->getIncomeData();


        // Fetch the last order and related information
        $lastOrder = Order::with(['user', 'address', 'items'])->latest()->first();

        // Fetch total sales and other statistics as needed
        $totalSales = Order::sum('total_amount');
        $totalOrders = Order::count();

        // Group orders by category and sum their amounts
        $categories = Order::with('items.product.categories')
            ->take(5)
            ->get()
            ->groupBy(function($order) {
                return $order->items->first()->product->categories()->first()->name;
            })
            ->map(function ($orders, $category) {
                return [
                    'name' => $category,
                    'amount' => $orders->sum('total_amount'),
                    'details' => $orders->pluck('items')->flatten()->pluck('product.name')->unique()->implode(', ')
                ];
            });




        $paylogClub = PaymentLog::where("owner_type",get_class(Coach::first()))->sum('amount');
        // $paylogVendor = PaymentLog::where("owner_type",get_class(Vendor::first()))->sum('amount');

        return view('dashboard.index', compact('statistics','paymentLogs','percentageChange','totalBalance','incomeData','lastOrder', 'totalSales', 'totalOrders', 'categories',"paylogClub"));

        // $paylogClub = PaymentLog::where("owner_type",get_class(Coach::first()))->sum('amount');
        // $paylogVendor = PaymentLog::where("owner_type",get_class(Vendor::first()))->sum('amount');

        return view('dashboard.index', compact('statistics','paymentLogs','percentageChange','totalBalance','incomeData','lastOrder', 'totalSales', 'totalOrders', 'categories'));
    }

    private function calculatePercentageChange()
    {
        // Assuming you have logic to calculate the percentage change
        $lastWeekAmount = PaymentLog::whereBetween('created_at', [now()->subWeeks(2), now()->subWeek()])->sum('amount');
        $thisWeekAmount = PaymentLog::whereBetween('created_at', [now()->subWeek(), now()])->sum('amount');

        if ($lastWeekAmount == 0) {
            return $thisWeekAmount > 0 ? 100 : 0;
        }

        return (($thisWeekAmount - $lastWeekAmount) / $lastWeekAmount) * 100;
    }

    private function getIncomeData()
    {
        $startDate = Carbon::now()->subYear()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        // Generate all months between startDate and endDate
        $period = new \DatePeriod(
            $startDate,
            new \DateInterval('P1M'),
            $endDate
        );

        // Initialize the array with all months set to 0
        $incomeData = [];
        foreach ($period as $date) {
            $month = $date->format('M');
            $incomeData[$month] = 0;
        }

        // Fetch actual income data from the database
        $actualIncomeData = PaymentLog::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE_FORMAT(created_at, "%M") as month, SUM(amount) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        // Fill the incomeData array with actual values
        foreach ($actualIncomeData as $month => $total) {
            $incomeData[$month] = $total;
        }

        return $incomeData;
    }

}
