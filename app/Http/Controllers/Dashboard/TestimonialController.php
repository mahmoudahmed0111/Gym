<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Testimonial::all();
        return view('dashboard.testimonials.index', compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.testimonials.create');
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

        if($request->hasFile('img'))
        {
            $data['img'] = UploadImage($request->file('img'), "testimonials");
        }

        Testimonial::create($data);

        return redirect()->route('testimonials.index')->with('success', __('models.added_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Testimonial::find($id);
        return view('dashboard.testimonials.show' , compact("data"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Testimonial::find($id);
        return view('dashboard.testimonials.edit' , compact("data"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'img' => 'nullable|image',
        ]);

        $testimonial = Testimonial::find($id);

        $data = $request->except('img');

        if($request->hasFile('img'))
        {
            $data['img'] = UploadImage($request->file('img'), 'testimonials');
        }

        $testimonial->update($data);


        return redirect()->route('testimonials.index')->with('success', __('models.updated_successfully'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::find($id);
        $testimonial->delete();
        return redirect()->route('testimonials.index')->with('success', __('models.deleted_successfully'));
    }
}
