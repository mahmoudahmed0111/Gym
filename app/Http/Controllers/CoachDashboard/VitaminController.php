<?php

namespace App\Http\Controllers\CoachDashboard;

use App\Http\Controllers\Controller;
use App\Models\Vitamin;
use Illuminate\Http\Request;

class VitaminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coachId = auth('coach')->user()->id;
        $data = Vitamin::where('coach_id', $coachId)->get();
        return view('coach-dashboard.vitamins.index', compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coach-dashboard.vitamins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'img' => 'nullable|image',
            'desc' => 'required',
            'price' => 'required|integer',
        ]);

        $data = $request->except('img');

        $coachId = auth('coach')->user()->id;

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "Vitamins");
        }

        // Assign coach_id from the authenticated user
        $data['coach_id'] = $coachId;

        Vitamin::create($data);

        return redirect(route('coach.vitamins.index'))->with('success', __('models.added_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vitamin = Vitamin::find($id);
        return view('coach-dashboard.vitamins.edit', compact("vitamin"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'img' => 'nullable|image',
            'desc' => 'required',
            'price' => 'required|integer',
        ]);

        $vitamin = Vitamin::find($id);

        // Ensure the authenticated coach is the owner of the vitamin
        $coachId = auth('coach')->user()->id;
        if ($vitamin->coach_id !== $coachId) {
            return redirect()->route('coach.vitamins.index')->withErrors('You do not have permission to edit this vitamin.');
        }

        $data = $request->except('img');

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "Vitamins");
        }

        $vitamin->update($data);

        return redirect(route('coach.vitamins.index'))->with('success', __('models.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vitamin = Vitamin::find($id);
        $vitamin->delete();
        return redirect(route('coach.vitamins.index'))->with('success', __('models.deleted_successfully'));
    }
}
