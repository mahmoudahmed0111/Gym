<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $data = Category::get();
        return view("dashboard.categories.index", compact("data"));
    }


    public function create()
    {
        return view("dashboard.categories.create");

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

        $admin = Category::create($data);

        return redirect(route('categories.index'))->with('success', __('models.added_successfully'));
    }


    public function show($id)
    {
        $data = Category::find($id);
        return view("dashboard.categories.show", compact("data"));
    }


    public function edit($id)
    {
        $data = Category::find($id);
        return view("dashboard.categories.edit", compact("data"));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'nullable',
            'image' => 'nullable|image',
        ]);
        $admin = Category::find($id);
        $data = $request->except( 'image');

        if ($request->hasFile('image')) {
            $data['image'] = UploadImage($request->file('image'), "images");
        }
        $admin->update($data);
        return redirect(route('categories.index'))->with('success', __('models.edited_successfully'));
    }


    public function destroy($id)
    {
        $admin = Category::find($id);
        $admin->delete();
        return redirect(route('categories.index'))->with('success', __('models.deleted_successfully'));

    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        // return response()->json(['success' => true ,"ids"=> $ids]);
        foreach ($ids as $id) {
            $admin = Category::find($id);
            if ($admin) {
                $admin->delete();
            }
        }
        return response()->json(['success' => true]);
    }
    public function toggleActivation(Request $request)
    {
        $admin = Category::findOrFail($request->id);
        $admin->is_active = !$admin->is_active;
        $admin->save();

        return response()->json(['success' => true, 'is_active' => $admin->is_active]);
    }

}
