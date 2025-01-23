<?php

namespace App\Http\Controllers\ClubDashboard;

use App\Http\Controllers\Controller;
use App\Models\AdminToClubPayment;
use App\Models\PaymentLog;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        $club = \Auth::guard('club')->user();
        $payments = AdminToClubPayment::where("club_id",auth("club")->id())->with(['admin', 'club'])->get();
        $paymentLogs = PaymentLog::where('owner_id', $club->id)->where('owner_type', 'App\Models\Club')->latest()->get();
        return view('club-dashboard.wallet.index', compact('paymentLogs',"club","payments"));
    }
}
