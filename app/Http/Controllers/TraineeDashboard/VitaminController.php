<?php

namespace App\Http\Controllers\TraineeDashboard;

use App\Models\Vitamin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VitaminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the currently authenticated trainee
        $trainee = Auth::guard('trainee')->user();

        // Get the coach of the current trainee
        $coachId = $trainee->coach_id;

        // Fetch vitamins associated with the current coach
        $data = Vitamin::where('coach_id', $coachId)->get();
        return view('trainee-dashboard.vitamins.index', compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
