<?php

namespace App\Http\Controllers\TraineeDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {
        // $statistics = [
        //     'users' => User::count(),
        //     'categories' => CategoryProduct::count(),
        //     'balance' =>auth("vendor")->user()->balance,
        //     'paid' =>AdminToVendorPayment::where("vendor_id",auth("vendor")->id())->sum('amount'),
        //     'offers' => Product::where("owner_type",get_class(auth("vendor")->user()))->where("owner_id",auth("vendor")->id())->where("price_after_discount","!=", 0)->count(),
        //     'products' => Product::where("owner_type",get_class(auth("vendor")->user()))->where("owner_id",auth("vendor")->id())->where("price_after_discount",0)->count(),
        //     'orders' => OrderItems::where("owner_type",get_class(auth("vendor")->user()))->where("owner_id",auth("vendor")->id())->count(),
        // ];
        // $paymentLogs = PaymentLog::where("owner_type",get_class(auth("vendor")->user()))->where("owner_id",auth("vendor")->id())->latest()->take(5)->get();
        // $percentageChange = $this->calculatePercentageChange();
        // $totalBalance = PaymentLog::where("owner_type",get_class(auth("vendor")->user()))->where("owner_id",auth("vendor")->id())->sum('amount');
        // $incomeData = $this->getIncomeData();


        // // Fetch the last order and related information
        // $items = OrderItems::where("owner_type",get_class(auth("vendor")->user()))->where("owner_id",auth("vendor")->id())->take(5)->get();

        //     $topProducts = auth("vendor")->user()->products()->with('reviews')
        //     ->withAvg('reviews', 'rating')
        //     ->orderByDesc('reviews_avg_rating')
        //     ->take(8)
        //     ->get();



        return view('trainee-dashboard.index');


        // return view('vendor-dashboard.index', compact('statistics','paymentLogs','percentageChange','totalBalance','incomeData','topProducts', 'items'));
    }

    // private function calculatePercentageChange()
    // {
    //     // Assuming you have logic to calculate the percentage change
    //     $lastWeekAmount = PaymentLog::whereBetween('created_at', [now()->subWeeks(2), now()->subWeek()])->sum('amount');
    //     $thisWeekAmount = PaymentLog::whereBetween('created_at', [now()->subWeek(), now()])->sum('amount');

    //     if ($lastWeekAmount == 0) {
    //         return $thisWeekAmount > 0 ? 100 : 0;
    //     }

    //     return (($thisWeekAmount - $lastWeekAmount) / $lastWeekAmount) * 100;
    // }

    // private function getIncomeData()
    // {
    //     $startDate = Carbon::now()->subYear()->startOfMonth();
    //     $endDate = Carbon::now()->endOfMonth();

    //     // Generate all months between startDate and endDate
    //     $period = new \DatePeriod(
    //         $startDate,
    //         new \DateInterval('P1M'),
    //         $endDate
    //     );

    //     // Initialize the array with all months set to 0
    //     $incomeData = [];
    //     foreach ($period as $date) {
    //         $month = $date->format('M');
    //         $incomeData[$month] = 0;
    //     }

    //     // Fetch actual income data from the database
    //     $actualIncomeData = PaymentLog::where("owner_type",get_class(auth("vendor")->user()))->where("owner_id",auth("vendor")->id())->whereBetween('created_at', [$startDate, $endDate])
    //         ->selectRaw('DATE_FORMAT(created_at, "%M") as month, SUM(amount) as total')
    //         ->groupBy('month')
    //         ->pluck('total', 'month');

    //     // Fill the incomeData array with actual values
    //     foreach ($actualIncomeData as $month => $total) {
    //         $incomeData[$month] = $total;
    //     }

    //     return $incomeData;
    // }

}
