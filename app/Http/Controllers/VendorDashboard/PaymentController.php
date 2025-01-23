<?php

namespace App\Http\Controllers\VendorDashboard;

use App\Http\Controllers\Controller;
use App\Models\AdminToVendorPayment;
use App\Models\PaymentLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $VendorId = Auth::guard('vendor')->id();
        $paymentLogs = PaymentLog::where('owner_id', $VendorId)->where('owner_type', 'App\Models\Vendor')->latest()->get();
        return view('vendor-dashboard.payment_logs.index', compact('paymentLogs'));
    }
    public function AdminToVendorPayment()
    {
        $payments = AdminToVendorPayment::where("vendor_id",auth("vendor")->id())->with(['admin', 'vendor'])->get();
        return view('vendor-dashboard.payment_logs.pay', compact('payments'));
    }

}
