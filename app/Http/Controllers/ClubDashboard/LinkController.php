<?php

namespace App\Http\Controllers\ClubDashboard;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Link::all();
        return view('club-dashboard.links.index', compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('club-dashboard.links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'link' => 'required|url|max:255',
            'icon' => 'required|string|max:255'
        ]);

        $data = $request->all();

        Link::create($data);

        return redirect()->route('club.links.index')->with('success', __('models.added_successfully'));


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
        $link = Link::find($id);
        return view('club-dashboard.links.edit' , compact("link"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'link' => 'required|url|max:255',
            'icon' => 'required|string|max:255'
        ]);

        $link =  Link::find($id);
        $data = $request->all();

        $link->update($data);

        return redirect()->route('club.links.index')->with('success', __('models.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $link =  Link::find($id);
        $link->delete();
        return redirect()->route('club.links.index')->with('success', __('models.deleted_successfully'));
    }
}
