<?php

namespace App\Http\Controllers\ClubDashboard;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Club;
use App\Models\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Club::findOrFail(auth("club")->id());
        $categories = Category::all();

        // return $data ;
        return view("club-dashboard.settings", compact('data','categories'));
    }

    public function store(Request $request)
    {
        $club = Club::findOrFail(auth("club")->id());
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|string|min:8',
            'start_time' => 'required',
            'end_time' => 'required',
            'category_id' => 'required|array',
            'category_durations' => 'required|array', // Add validation for category_durations
            'category_durations.*' => 'required|integer|', // Validate each duration value
        ]);
        $data = $request->except('password', 'img', 'category_id', 'category_durations');

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "users");
            if ($club->img) {
                \Storage::disk('public')->delete($club->img);
            }
        }

        $club->update($data);

        // Sync categories with durations
        $syncData = [];
        foreach ($request->category_id as  $categoryId) {
            $syncData[$categoryId] = [
                'duration' => $request->category_durations[$categoryId]*60,
            ];
        }

        $club->categories()->sync($syncData);

        return redirect()->back()->with('success', __('models.edited_successfully'));
    }




}
