<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Team::all();
        return view('dashboard.team.index' , compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.team.create');
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
            $data['img'] = UploadImage($request->file('img'), "team");
        }

        Team::create($data);

        return redirect()->route('team.index')->with('success', __('models.added_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Team::find($id);
        return view('dashboard.team.show' , compact("data"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Team::find($id);
        return view('dashboard.team.edit' , compact("data"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'img' => 'nullable|image'
        ]);

        $team = Team::find($id);

        $data = $request->except('img');

        if($request->hasFile('img'))
        {
            $data['img'] = UploadImage($request->file('img'), 'team');
        }

        $team->update($data);

        return redirect()->route('team.index')->with('success', __('models.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = Team::find($id);
        $team->delete();
        return redirect()->route('team.index')->with('success', __('models.deleted_successfully'));
    }
}
