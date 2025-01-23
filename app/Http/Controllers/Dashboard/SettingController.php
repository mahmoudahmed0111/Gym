<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Admin;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Admin::findOrFail(auth("admin")->id());

        // return $data ;
        return view("dashboard.settings", compact('data'));
    }

    public function store(Request $request)
    {
        $Admin = Admin::findOrFail(auth("admin")->id());
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
            if ($Admin->img) {
                \Storage::disk('public')->delete($Admin->img);
            }
        }

        $Admin->update($data);



        return redirect()->back()->with('success', __('models.edited_successfully'));
    }

    public function setting()
    {
        $data = Setting::first();
        return view("dashboard.settings_website", compact('data'));
    }

    public function update_setting(Request $request)
    {
        $Setting = Setting::first();
        $request->validate([
            'facebook_link'  => 'nullable|string',
            'instagram_link' => 'nullable|string',
            'whats_up'       => 'nullable|string',
            'phone'          => 'nullable|string',
            'x_link'         => 'nullable|string',
            'snapchat'       => 'nullable|string',
            'website'         => 'nullable|string',
            'tax'         => 'required|string',
        ]);
        $data = $request->all();
        $Setting->update($data);
        return redirect()->back()->with('success', __('models.edited_successfully'));
    }



}
