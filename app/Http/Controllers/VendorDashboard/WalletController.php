<?php

namespace App\Http\Controllers\VendorDashboard;

use App\Http\Controllers\Controller;
use App\Models\AdminToVendorPayment;
use App\Models\PaymentLog;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        $vendor = \Auth::guard('vendor')->user();
        $payments = AdminToVendorPayment::where("vendor_id",auth("vendor")->id())->with(['admin', 'vendor'])->get();
        $paymentLogs = PaymentLog::where('owner_id', $vendor->id)->where('owner_type', 'App\Models\Vendor')->latest()->get();
        return view('vendor-dashboard.wallet.index', compact('paymentLogs',"vendor","payments"));
    }
}
