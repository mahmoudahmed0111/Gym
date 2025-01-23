<?php

namespace App\Http\Controllers\VendorDashboard;

use App\Http\Controllers\Controller;

use App\Models\Support;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("vendor-dashboard.support");
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);
        $message = $validated['message'];
        $support =  Support::create([
            'message' => $message,
            'owner_type' => get_class(Vendor::first()),
            'owner_id' => auth("vendor")->user()->id,
        ]);

        return redirect()->back()->with('success', __('models.added_successfully'));

    }
}
