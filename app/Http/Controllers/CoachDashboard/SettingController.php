<?php

namespace App\Http\Controllers\CoachDashboard;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Coaching\Coach;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $data = Coach::findOrFail(auth("coach")->id());

        // return $data ;
        return view("coach-dashboard.settings", compact('data'));
    }

    public function store(Request $request)
    {
        $coach = Coach::findOrFail(auth("coach")->id());
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
            if ($coach->img) {
                \Storage::disk('public')->delete($coach->img);
            }
        }

        $coach->update($data);



        return redirect()->back()->with('success', __('models.edited_successfully'));
    }

}
