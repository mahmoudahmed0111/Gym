<?php

namespace App\Http\Controllers\VendorDashboard;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $data = Vendor::findOrFail(auth("vendor")->id());

        // return $data ;
        return view("vendor-dashboard.settings", compact('data'));
    }

    public function store(Request $request)
    {
        $vendor = Vendor::findOrFail(auth("vendor")->id());
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|string|min:8',
        ]);
        $data = $request->except('password', 'img');

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "users");
            if ($vendor->img) {
                \Storage::disk('public')->delete($vendor->img);
            }
        }

        $vendor->update($data);



        return redirect()->back()->with('success', __('models.edited_successfully'));
    }

}
