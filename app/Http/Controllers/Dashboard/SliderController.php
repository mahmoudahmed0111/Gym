<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{

    public function index(Request $request)
    {
        $data = Slider::get();
        return view("dashboard.slider.index", compact("data"));
    }


    public function create()
    {
        return view("dashboard.slider.create");

    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);
        $data = $request->except( 'image');


        if ($request->hasFile('image')) {
            $data['image'] = UploadImage($request->file('image'), "images");
        }

        $admin = Slider::create($data);

        return redirect(route('sliders.index'))->with('success', __('models.added_successfully'));
    }


    public function show($id)
    {
        $data = Slider::find($id);
        return view("dashboard.slider.show", compact("data"));
    }


    public function edit($id)
    {
        $data = Slider::find($id);
        return view("dashboard.slider.edit", compact("data"));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $admin = Slider::find($id);
        $data = $request->except( 'image');

        if ($request->hasFile('image')) {
            $data['image'] = UploadImage($request->file('image'), "images");
        }
        $admin->update($data);
        return redirect(route('sliders.index'))->with('success', __('models.edited_successfully'));
    }


    public function destroy($id)
    {
        $admin = Slider::find($id);
        $admin->delete();
        return redirect(route('sliders.index'))->with('success', __('models.deleted_successfully'));

    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        // return response()->json(['success' => true ,"ids"=> $ids]);
        foreach ($ids as $id) {
            $admin = Slider::find($id);
            if ($admin) {
                $admin->delete();
            }
        }
        return response()->json(['success' => true]);
    }
    public function toggleActivation(Request $request)
    {
        $admin = Slider::findOrFail($request->id);
        $admin->is_active = !$admin->is_active;
        $admin->save();

        return response()->json(['success' => true, 'is_active' => $admin->is_active]);
    }


}
