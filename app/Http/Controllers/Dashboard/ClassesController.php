<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Classe::all();
        return view('dashboard.classes.index' , compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.classes.create');
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
            $data['img'] = UploadImage($request->file('img'), "classes");
        }

        Classe::create($data);

        return redirect()->route('classes.index')->with('success', __('models.added_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Classe::find($id);
        return view('dashboard.classes.edit' , compact("data"));
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

        $classes = Classe::find($id);

        $data = $request->except('img');

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "classes");
        }

        $classes->update($data);

        return redirect()->route('classes.index')->with('success', __('models.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $classes = Classe::find($id);
        $classes->delete();
        return redirect()->route('classes.index')->with('success', __('models.deleted_successfully'));
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        // return response()->json(['success' => true ,"ids"=> $ids]);
        foreach ($ids as $id) {
            $admin = Classe::find($id);
            if ($admin) {
                $admin->delete();
            }
        }
        return response()->json(['success' => true]);
    }
    public function toggleActivation(Request $request)
    {
        $admin = Classe::findOrFail($request->id);
        $admin->is_active = !$admin->is_active;
        $admin->save();

        return response()->json(['success' => true, 'is_active' => $admin->is_active]);
    }
}
