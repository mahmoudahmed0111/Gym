<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\AdminToClubPayment;
use App\Models\AdminToVendorPayment;
use App\Models\PaymentLog;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentLogs = PaymentLog::latest()->get();
        return view('dashboard.payment_logs.index', compact('paymentLogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function AdminToClubPayment()
    {
        $payments = AdminToClubPayment::with(['admin', 'club'])->get();

        return view('dashboard.payment_logs.pay', compact('payments'));
    }
    public function AdminToVendorPayment()
    {
        $payments = AdminToVendorPayment::with(['admin', 'vendor'])->get();

        return view('dashboard.payment_logs.pay_vendor', compact('payments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view("dashboard.payment.show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::all();
        return view("dashboard.payment.create", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return back();
    }
}
