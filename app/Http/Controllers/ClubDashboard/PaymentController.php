<?php

namespace App\Http\Controllers\ClubDashboard;

use App\Http\Controllers\Controller;
use App\Models\AdminToClubPayment;
use App\Models\PaymentLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $clubId = Auth::guard('club')->id();
        $paymentLogs = PaymentLog::where('owner_id', $clubId)->where('owner_type', 'App\Models\Club')->latest()->get();
        return view('club-dashboard.payment_logs.index', compact('paymentLogs'));
    }
    public function AdminToClubPayment()
    {
        $payments = AdminToClubPayment::where("club_id",auth("club")->id())->with(['admin', 'club'])->get();
        return view('club-dashboard.payment_logs.pay', compact('payments'));
    }

}
