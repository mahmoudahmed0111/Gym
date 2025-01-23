<?php

namespace App\Http\Controllers\Dashboard;

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
        return view("dashboard.vendors.index", compact("data"));
    }


    public function create()
    {
        $categories = Category::all();
        $packages = Package::where("type", "vendor")->get();
        return view("dashboard.vendors.create",compact('categories','packages'));

    }

    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email',
            'mobile' => 'required|unique:vendors,mobile',
            'password' => 'required|string|min:8',
            'img' => 'nullable|image',
        ]);
        $data = $request->except('password', 'img');

        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "images");
        }

        $club = Vendor::create($data);
        $package = Package::find($request->package_id);
        $club->subscriptions()->create([
            'package_id' => $request->package_id,
            'start_date' => now(),
            'end_date' => $package->time==-1? null: now()->addMonths($package->time),
        ]);
        return redirect(route('vendors.index'))->with('success', __('models.added_successfully'));
    }


    public function show($id)
    {
        $data = Vendor::find($id);

        return view("dashboard.vendors.show", compact("data"));
    }


    public function edit($id)
    {
        $data = Vendor::find($id);
        $categories = Category::all();
        $packages = Package::where("type", "vendor")->get();

        return view("dashboard.vendors.edit", compact("data","categories","packages"));
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
        $club = Vendor::find($id);
        $data = $request->except('password', 'img');

        $data['password'] = $request->password ? bcrypt($request->password) : $club->password;

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "users");
        }
        if($request->package_id){
            $package = Package::find($request->package_id);
            $club->subscriptions()->delete();
            $club->subscriptions()->create([
                'amount' => $package->price,
                'package_id' => $request->package_id,
                'start_date' => now(),

            ]);
        }
        $club->update($data);
        return redirect(route('vendors.index'))->with('success', __('models.edited_successfully'));
    }


    public function destroy($id)
    {
        $club = Vendor::find($id);
        $club->delete();
        return redirect(route('vendors.index'))->with('success', __('models.deleted_successfully'));

    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        // return response()->json(['success' => true ,"ids"=> $ids]);
        foreach ($ids as $id) {
            $admin = Vendor::find($id);
            if ($admin) {
                $admin->delete();
            }
        }
        return response()->json(['success' => true]);
    }
    public function toggleActivation(Request $request)
    {
        $admin = Vendor::findOrFail($request->id);
        $admin->is_active = !$admin->is_active;
        $admin->save();

        return response()->json(['success' => true, 'is_active' => $admin->is_active]);
    }
    public function pay(Request $request ,$id)
    {
        $request->validate([
            'payment' => 'required|numeric|min:0.01',
        ]);

        $payment = AdminToVendorPayment::create([
            'admin_id' => auth("admin")->id(),
            'vendor_id' => $id,
            'amount' => $request->payment,
            'currency' => $request->currency ?? 'SAR',
        ]);

        $vendor = Vendor::find($id);
        $vendor->balance -= $request->payment;
        $vendor->save();

        return redirect(route('vendors.index'))->with('success', __('models.paid_successfully'));
    }


}
