<?php

namespace App\Http\Controllers\TraineeDashboard;

use App\Models\Category;
use App\Models\Training;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainee = Auth::guard('trainee')->user(); // Get the currently authenticated trainee

        // Get the categories through the trainings assigned by the trainee's coach
        $categories = Category::whereHas('trainings', function($query) use ($trainee) {
            $query->where('coach_id', $trainee->coach_id) // Filter trainings by the trainee's coach
                ->whereHas('trainees', function($subQuery) use ($trainee) {
                    $subQuery->where('trainee_id', $trainee->id); // Filter by the specific trainee
                });
        })->get();

        return view('trainee-dashboard.trainings.index', compact('categories'));
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



    public function show($categoryId)
    {
       // Get the authenticated trainee
    $trainee = Auth::guard('trainee')->user();

    // Fetch the category and associated trainings
    $category = Category::with('trainings')->findOrFail($categoryId);

    $trainings = $category->trainings; // Get trainings associated with the category

        return view('trainee-dashboard.trainings.show', compact('trainings', 'category'));
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
