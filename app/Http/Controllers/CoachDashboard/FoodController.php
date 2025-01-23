<?php

namespace App\Http\Controllers\CoachDashboard;

use App\Models\Food;
use App\Models\Trainee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coach_id = Auth('coach')->user()->id ;
        $data = Food::where('coach_id', $coach_id)->get();
        return view('coach-dashboard.food.index', compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('coach-dashboard.food.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'img' => 'nullable|image',
            'amount' => 'required|integer',
            'fat' => 'required|integer',
            'protein' => 'required|integer',
            'carbohydrate' => 'required|integer',
        ]);

        $coachId = auth('coach')->user()->id;

        $data = $request->except('img');

        $data['coach_id'] = $coachId ;

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "Food");
        }

        Food::create($data);

        return redirect(route('coach.food.index'))->with('success', __('models.added_successfully'));
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
        $food = Food::find($id);
        return view('coach-dashboard.food.edit', compact("food"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'img' => 'nullable|image',
            'amount' => 'required|integer',
            'fat' => 'required|integer',
            'protein' => 'required|integer',
            'carbohydrate' => 'required|integer',
        ]);

        $food = Food::find($id);

        $data = $request->except('img');

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "Food");
        }

        $food->update($data);

        return redirect(route('coach.food.index'))->with('success', __('models.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $food = Food::find($id);
        $food->delete();
        return redirect(route('coach.food.index'))->with('success', __('models.deleted_successfully'));
    }

    /**
     * Show the form to assign meals to a trainee.
     */

}
