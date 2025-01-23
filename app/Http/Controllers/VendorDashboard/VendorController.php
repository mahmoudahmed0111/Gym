<?php

namespace App\Http\Controllers\VendorDashboard;

use App\Http\Controllers\Controller;
use App\Models\AdminToVendorPayment;
use App\Models\Category;
use App\Models\Package;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{

    public function index(Request $request)
    {
        $data = Vendor::get();
        return view("vendor-dashboard.vendors.index", compact("data"));
    }


}
