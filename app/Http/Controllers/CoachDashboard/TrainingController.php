<?php

namespace App\Http\Controllers\CoachDashboard;

use App\Models\Trainee;
use App\Models\Category;
use App\Models\Training;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{

    public function index()
    {
        $coach_id = Auth::guard('coach')->user()->id;

        // Fetch the trainings assigned by the specific coach
        $data = Training::whereHas('trainees', function ($query) use ($coach_id) {
            $query->where('coach_id', $coach_id); // Adjust based on your actual schema
        })->get();

        return view('coach-dashboard.trainings.index', compact('data'));
    }


    public function create()
    {
        $coach_id = Auth::guard('coach')->user()->id;
        $trainees = Trainee::where('coach_id', $coach_id)->get(); // Fetch trainees assigned to the coach
        $categories = Category::where('type', 'training')->get();
        return view("coach-dashboard.trainings.create", compact("categories", "trainees"));

    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'video' => 'required|string',
            'iframe' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'trainee_ids' => 'required|array', // Ensure it's an array of trainee IDs
            'trainee_ids.*' => 'exists:trainees,id', // Validate each ID exists in the trainees table
        ]);

        // Prepare the data for the new training, excluding trainee IDs
        $data = $request->except('trainee_ids');
        $data['coach_id'] = Auth('coach')->user()->id; // Assign the currently authenticated coach

        // Create the training with the prepared data
        $training = Training::create($data);

        // Attach the selected trainees to the newly created training
        $training->trainees()->attach($request->trainee_ids);

        // Redirect back to the coach's training index with a success message
        return redirect()->route('coach.trainings.index')->with('success', __('models.added_successfully'));
    }





    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $training = Training::findOrFail($id);
        $coach_id = Auth::guard('coach')->user()->id;
        $trainees = Trainee::where('coach_id', $coach_id)->get(); // Fetch trainees assigned to the coach
        $categories = Category::where('type', 'training')->get();
        return view('coach-dashboard.trainings.edit', compact('training', 'categories', "trainees"));
    }


    public function update(Request $request, $id)
{
    // Validate the request
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'desc' => 'required',
        'video' => 'required',
        'iframe' => 'required',
        'category_id' => 'required|exists:categories,id',
        'trainee_ids' => 'required|array',
        'trainee_ids.*' => 'exists:trainees,id',
    ]);

    // Find the training record
    $training = Training::find($id);

    if (!$training) {
        return redirect()->route('coach.trainings.index')->with('error', 'Training not found');
    }

    // Get the authenticated coach ID
    $coach_id = Auth::guard('coach')->user()->id;

    // Update the training record
    $training->update([
        'name' => $validatedData['name'],
        'desc' => $validatedData['desc'],
        'video' => $validatedData['video'],
        'iframe' => $validatedData['iframe'],
        'category_id' => $validatedData['category_id'],
        'coach_id' => $coach_id,
    ]);

    // Update the relationship with trainees
    $training->trainees()->sync($validatedData['trainee_ids']);

    return redirect()->route('coach.trainings.index')->with('success', __('Training updated successfully.'));
}






    public function destroy($id)
    {
        $user = Training::find($id);

        $user->delete();

        return redirect(route('coach.trainings.index'))->with('success', __('models.deleted_successfully'));

    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        // return response()->json(['success' => true ,"ids"=> $ids]);
        foreach ($ids as $id) {
            $user = Training::find($id);
            if ($user) {
                $user->delete();
            }
        }
        return response()->json(['success' => true]);
    }







}
