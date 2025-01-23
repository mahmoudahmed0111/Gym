<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\Club;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Package;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Coaching\Coach;
use App\Models\AdminToClubPayment;
use App\Http\Controllers\Controller;

class CoachController extends Controller
{

    public function index(Request $request)
    {
        $data = Coach::with('city','country')->get();
        return view("dashboard.coachs.index", compact("data"));
    }


    public function create()
    {
        $countries= Country::all();
        return view("dashboard.coachs.create", compact('countries'));
    }

    public function getCitiesByCountry($country_id)
    {
        $cities = City::where('country_id', $country_id)->get();
        return response()->json($cities);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:coaches,email',
            'mobile' => 'required|unique:coaches,mobile',
            'password' => 'required|string|min:8',
            'img' => 'nullable',
        ]);
        $data = $request->except('password', 'img');

        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "images");
        }

       Coach::create($data);

        return redirect(route('coachs.index'))->with('success', __('models.added_successfully'));
    }


    public function show($id)
    {
        $data = Coach::find($id);
        return view("dashboard.coachs.show", compact("data"));
    }


    public function edit($id)
    {
        $data = Coach::find($id);
        $countries= Country::all();

        return view("dashboard.coachs.edit", compact("data", "countries"));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email|',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|string|min:8',
        ]);
        $club = Coach::find($id);
        $data = $request->except('password', 'img');

        $data['password'] = $request->password ? bcrypt($request->password) : $club->password;

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "users");
        }
        $club->update($data);
        $package = Package::find($request->package_id);
        $club->subscriptions()->delete();
        $club->subscriptions()->create([
            'amount' => $package->price,
            'package_id' => $request->package_id,
            'start_date' => now(),
            'end_date' => $package->time == -1 ? null : now()->addMonths($package->time),
        ]);
        return redirect(route('coachs.index'))->with('success', __('models.edited_successfully'));
    }


    public function destroy($id)
    {
        $club = Coach::find($id);
        $club->delete();
        return redirect(route('coachs.index'))->with('success', __('models.deleted_successfully'));
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        // return response()->json(['success' => true ,"ids"=> $ids]);
        foreach ($ids as $id) {
            $admin = Coach::find($id);
            if ($admin) {
                $admin->delete();
            }
        }
        return response()->json(['success' => true]);
    }
    public function toggleActivation(Request $request)
    {
        $admin = Coach::findOrFail($request->id);
        $admin->is_active = !$admin->is_active;
        $admin->save();

        return response()->json(['success' => true, 'is_active' => $admin->is_active]);
    }
    public function pay(Request $request, $id)
    {
        $request->validate([
            'payment' => 'required|numeric|min:0.01',
        ]);

        $payment = AdminToClubPayment::create([
            'admin_id' => auth("admin")->id(),
            'club_id' => $id,
            'amount' => $request->payment,
            'currency' => $request->currency ?? 'SAR',
        ]);

        $club = Coach::find($id);
        $club->balance -= $request->payment;
        $club->save();

        return redirect(route('coachs.index'))->with('success', __('models.paid_successfully'));
    }
}
