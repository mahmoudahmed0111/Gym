<?php

namespace App\Http\Controllers\VendorDashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{

    public function index(Request $request)
    {
        $data = Club::get();
        return view("dashboard.clubs.index", compact("data"));
    }


    public function create()
    {
        return view("dashboard.clubs.create");

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clubs,email',
            'mobile' => 'required|unique:clubs,mobile',
            'password' => 'required|string|min:8',
            'img' => 'nullable|image',
            'lng' => 'required',
            'lat' => 'required',
            'location' => 'required',
        ]);
        $data = $request->except('password', 'img');

        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "images");
        }

        $club = Club::create($data);

        return redirect(route('clubs.index'))->with('success', __('models.added_successfully'));
    }


    public function show($id)
    {
        $data = Club::find($id);
        return view("dashboard.clubs.show", compact("data"));
    }


    public function edit($id)
    {
        $data = Club::find($id);
        return view("dashboard.clubs.edit", compact("data"));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email|',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|string|min:8',
            'lng' => 'required',
            'lat' => 'required',
            'location' => 'required',
        ]);
        $club = Club::find($id);
        $data = $request->except('password', 'img');

        $data['password'] = $request->password ? bcrypt($request->password) : $club->password;

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "users");
        }
        $club->update($data);
        return redirect(route('clubs.index'))->with('success', __('models.edited_successfully'));
    }


    public function destroy($id)
    {
        $club = Club::find($id);
        $club->delete();
        return redirect(route('clubs.index'))->with('success', __('models.deleted_successfully'));

    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        // return response()->json(['success' => true ,"ids"=> $ids]);
        foreach ($ids as $id) {
            $admin = Club::find($id);
            if ($admin) {
                $admin->delete();
            }
        }
        return response()->json(['success' => true]);
    }
    public function toggleActivation(Request $request)
    {
        $admin = Club::findOrFail($request->id);
        $admin->is_active = !$admin->is_active;
        $admin->save();

        return response()->json(['success' => true, 'is_active' => $admin->is_active]);
    }


}
