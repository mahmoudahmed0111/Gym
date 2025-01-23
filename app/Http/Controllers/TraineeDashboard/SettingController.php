<?php

namespace App\Http\Controllers\TraineeDashboard;

use App\Http\Controllers\Controller;
use App\Models\Trainee;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $data = Trainee::findOrFail(auth("trainee")->id());

        // return $data ;
        return view("coach-dashboard.settings", compact('data'));
    }

    public function store(Request $request)
    {
        $trainee = Trainee::findOrFail(auth("trainee")->id());
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|string|min:8',
        ]);
        $data = $request->except('password', 'img');

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "trainees");
            if ($trainee->img) {
                \Storage::disk('public')->delete($trainee->img);
            }
        }

        $trainee->update($data);



        return redirect()->back()->with('success', __('models.edited_successfully'));
    }

}
