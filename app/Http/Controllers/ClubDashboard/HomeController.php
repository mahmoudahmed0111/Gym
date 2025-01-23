<?php

namespace App\Http\Controllers\ClubDashboard;

use App\Http\Controllers\Controller;
use App\Models\AdminToClubPayment;
use App\Models\Booking;
use App\Models\CategoryProduct;
use App\Models\Club;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\PaymentLog;
use App\Models\Product;
use App\Models\TypeCategory;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function dashboard()
    {
        $statistics = [
            'bookings' => Booking::where("club_id",auth("club")->id())->count(),
            'users' => User::whereIn("id",Booking::where("club_id",auth("club")->id())->pluck("user_id")->toArray())->count(),
            'places' => TypeCategory::where("club_id",auth("club")->id())->count(),
            'categories' => auth("club")->user()->categories()->count(),
            'balance' =>auth("club")->user()->balance,
            'paid' =>AdminToClubPayment::where("club_id",auth("club")->id())->sum('amount'),
        ];
        $paymentLogs = PaymentLog::where("owner_type",get_class(auth("club")->user()))->where("owner_id",auth("club")->id())->latest()->take(5)->get();
        $percentageChange = $this->calculatePercentageChange();
        $totalBalance = PaymentLog::where("owner_type",get_class(auth("club")->user()))->where("owner_id",auth("club")->id())->sum('amount');
        $incomeData = $this->getIncomeData();
        $items = $this->booking();

        // Get top places by booking count
        $topPlaces = \DB::table('bookings')
        ->where("club_id", auth("club")->id())
        ->select('type_category_id', \DB::raw('count(*) as total'))
        ->groupBy('type_category_id')
        ->orderByDesc('total')
        ->take(10) // Get top 10 places
        ->get();

    // Get the place details
    $topPlaces = $topPlaces->map(function ($booking) {
        $place = TypeCategory::find($booking->type_category_id);
        return [
            'name' => $place->name,
            'total' => $booking->total,
        ];
    });



        return view('club-dashboard.index', compact('statistics','paymentLogs','percentageChange','totalBalance','incomeData',"items","topPlaces"));
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
        $actualIncomeData = PaymentLog::where("owner_type",get_class(auth("club")->user()))->where("owner_id",auth("club")->id())->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE_FORMAT(created_at, "%M") as month, SUM(amount) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        // Fill the incomeData array with actual values
        foreach ($actualIncomeData as $month => $total) {
            $incomeData[$month] = $total;
        }

        return $incomeData;
    }

    public function booking()
    {
        // جلب جميع الفئات لعرضها في خيارات الفلترة
        $bookingsQuery = Booking::where("club_id",auth("club")->id())->where("is_active",true);

        $data = $bookingsQuery->latest()->get();

        return $data;
    }

}
