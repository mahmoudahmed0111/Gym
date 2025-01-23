<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Gallery::all();
        return view('dashboard.gallery.index', compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'img' => 'nullable|image',
        ]);

        $data = $request->except('img');

        if($request->hasFile('img'))
        {
            $data['img'] = UploadImage($request->file('img'), 'gallery');
        }

        Gallery::create($data);

        return redirect()->route('gallery.index')->with('success', __('models.added_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Gallery::find($id);
        return view('dashboard.gallery.show' , compact("data"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Gallery::find($id);
        return view('dashboard.gallery.edit' , compact("data"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'img' => 'nullable|image',
        ]);

        $gallery = Gallery::find($id);
        $data = $request->except('img');

        if($request->hasFile('img'))
        {
            $data['img'] = UploadImage($request->file('img'), 'gallery');
        }

        $gallery->update($data);

        return redirect()->route('gallery.index')->with('success', __('models.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = Gallery::find($id);
        $gallery->delete();
        return redirect()->route('gallery.index')->with('success', __('models.updated_successfully'));
    }

    public function toggleActivation(Request $request)
    {
        $admin = Gallery::findOrFail($request->id);
        $admin->is_active = !$admin->is_active;
        $admin->save();

        return response()->json(['success' => true, 'is_active' => $admin->is_active]);
    }
}
