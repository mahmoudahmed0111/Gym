<?php

namespace App\Http\Controllers\CoachDashboard;

use App\Models\Meal;
use App\Models\Trainee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coach_id = Auth::guard('coach')->user()->id; // Adjust the guard if needed

        // Fetch the meals with assigned trainees
        $data = Meal::whereHas('trainees', function ($query) use ($coach_id) {
            $query->where('coach_id', $coach_id);
        })->with('trainees')->get();

        return view('coach-dashboard.meals.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coach_id = Auth::guard('coach')->user()->id;
        $trainees = Trainee::where('coach_id', $coach_id)->get();
        return view('coach-dashboard.meals.create', compact('trainees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'amount' => 'required|integer',
            'fat' => 'required|integer',
            'protein' => 'required|integer',
            'carbohydrate' => 'required|integer',
            'trainee_ids' => 'required|array',
            'trainee_ids.*' => 'exists:trainees,id' // Validate each trainee ID exists
        ]);

        $coachId = Auth::guard('coach')->user()->id;

        $data = $request->all();

        $data['coach_id'] = $coachId ;

        $meal = Meal::create($data);

        $meal->trainees()->sync($request->input('trainee_ids'));

        return redirect(route('coach.meals.index'))->with('success', __('models.added_successfully'));
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
        $coach_id = Auth::guard('coach')->user()->id;
        $trainees = Trainee::where('coach_id', $coach_id)->get();
        $meal = Meal::find($id);
        return view('coach-dashboard.meals.edit', compact("meal", "trainees"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'amount' => 'required|integer',
            'fat' => 'required|integer',
            'protein' => 'required|integer',
            'carbohydrate' => 'required|integer',
            'trainee_ids' => 'required|array',
            'trainee_ids.*' => 'exists:trainees,id' // Validate each trainee ID exists
        ]);

        $meal = Meal::find($id);

        $data = $request->all();



        $meal->update($data);

        $meal->trainees()->sync($request->input('trainee_ids'));

        return redirect(route('coach.meals.index'))->with('success', __('models.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $meal = Meal::find($id);
        $meal->delete();
        return redirect(route('coach.meals.index'))->with('success', __('models.deleted_successfully'));
    }
}
