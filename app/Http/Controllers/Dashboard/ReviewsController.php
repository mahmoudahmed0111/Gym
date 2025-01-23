<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Review;
use App\Model\User;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{

    public function index(Request $request)
    {
        $data = Review::get();
        return view("dashboard.reviews.index", compact("data"));
    }


    public function create()
    {
        return view("dashboard.reviews.create");

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
        $data = Review::find($id);
        return view("dashboard.reviews.show", compact("data"));
    }


    public function edit($id)
    {
        $data = Review::find($id);
        return view("dashboard.reviews.edit", compact("data"));
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
        return redirect(route('reviews.index'))->with('success', __('models.edited_successfully'));
    }


    public function destroy($id)
    {
        $admin = Review::find($id);
        $admin->delete();
        return redirect(route('reviews.index'))->with('success', __('models.deleted_successfully'));

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
