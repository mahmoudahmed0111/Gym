<?php

namespace App\Http\Controllers\VendorDashboard;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Review;
use App\Model\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{

    public function index(Request $request)
    {
        $data = Product::where("owner_id", auth("vendor")->id())
        ->where("owner_type", get_class(Vendor::first()))
        ->withCount("reviews")
        ->orderByDesc("reviews_count")
        ->get();
        return view("vendor-dashboard.reviews.index", compact("data"));
    }


    public function create()
    {
        return view("vendor-dashboard.reviews.create");

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'nullable',
            'image' => 'nullable|image',
        ]);
        $data = $request->except( 'image');


        if ($request->hasFile('image')) {
            $data['image'] = UploadImage($request->file('image'), "images");
        }

        $admin = Review::create($data);

        return redirect(route('reviews.index'))->with('success', __('models.added_successfully'));
    }

    public function show($id)
    {
        $product = Product::with('reviews.user')->findOrFail($id);
        return view("vendor-dashboard.reviews.show", compact("product"));
    }



    public function edit($id)
    {
        $data = Review::find($id);
        return view("vendor-dashboard.reviews.edit", compact("data"));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'nullable',
            'image' => 'nullable|image',
        ]);
        $admin = Review::find($id);
        $data = $request->except( 'image');

        if ($request->hasFile('image')) {
            $data['image'] = UploadImage($request->file('image'), "images");
        }
        $admin->update($data);
        return redirect(route('vendor.reviews.index'))->with('success', __('models.edited_successfully'));
    }


    public function destroy($id)
    {
        $admin = Review::find($id);
        $admin->delete();
        return redirect(route('vendor.reviews.index'))->with('success', __('models.deleted_successfully'));

    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        // return response()->json(['success' => true ,"ids"=> $ids]);
        foreach ($ids as $id) {
            $admin = Review::find($id);
            if ($admin) {
                $admin->delete();
            }
        }
        return response()->json(['success' => true]);
    }
    public function toggleActivation(Request $request)
    {
        $admin = Review::findOrFail($request->id);
        $admin->is_active = !$admin->is_active;
        $admin->save();

        return response()->json(['success' => true, 'is_active' => $admin->is_active]);
    }
}
