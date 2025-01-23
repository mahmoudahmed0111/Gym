<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LandingSlider;
use Illuminate\Http\Request;

class LandingSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = LandingSlider::all();
        return view('dashboard.landing-slider.index', compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.landing-slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'img' => 'nullable|image',
         ]);
         $data = $request->except('img');

         if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "landingslider");
        }

        LandingSlider::create($data);

        return redirect()->route('landing-slider.index')->with('success', __('models.added_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = LandingSlider::find($id);
        return view('dashboard.landing-slider.show' , compact("data"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = LandingSlider::find($id);
        return view('dashboard.landing-slider.edit' , compact("data"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|string',
            'img' => 'nullable|image',
        ]);
        $landingslider = LandingSlider::find($id);
        $data = $request->except('img');

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "landingslider");
        }

        $landingslider->update($data);

        return redirect()->route('landing-slider.index')->with('success', __('models.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $landingslider = LandingSlider::find($id);
        $landingslider->delete();
        return redirect()->route('landing-slider.index')->with('success', __('models.deleted_successfully'));
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        // return response()->json(['success' => true ,"ids"=> $ids]);
        foreach ($ids as $id) {
            $admin = LandingSlider::find($id);
            if ($admin) {
                $admin->delete();
            }
        }
        return response()->json(['success' => true]);
    }
    public function toggleActivation(Request $request)
    {
        $admin = LandingSlider::findOrFail($request->id);
        $admin->is_active = !$admin->is_active;
        $admin->save();

        return response()->json(['success' => true, 'is_active' => $admin->is_active]);
    }
}
