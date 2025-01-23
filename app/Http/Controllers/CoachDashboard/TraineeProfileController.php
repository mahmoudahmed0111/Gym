<?php

namespace App\Http\Controllers\CoachDashboard;

use App\Models\Package;
use App\Models\Trainee;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\TraineeProfile;
use App\Http\Controllers\Controller;

class TraineeProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $trainee_id = Auth('coach')->user()->id ;
        // $data = TraineeProfile::where('trainee_id', $trainee_id)->get();
        $coach = auth('coach')->user();
        $data = TraineeProfile::where('coach_id', $coach->id)->get();
        return view('coach-dashboard.trainee_profile.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();
        $packages = Package::all();
        return view('coach-dashboard.trainee_profile.create', compact("categories", "packages"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'trainee_id' => 'required|exists:trainees,id',
            'age' => 'nullable|integer|min:1|max:150',
            'weight' => 'nullable|numeric|min:0|max:500',
            'height' => 'nullable|numeric|min:0|max:300',
            'bmi' => 'nullable|numeric|min:0',
            'body_fat_percentage' => 'nullable|numeric|min:0|max:100',
            'body_water_percentage' => 'nullable|numeric|min:0|max:100',
            'muscle_mass' => 'nullable|numeric|min:0|max:500',
            'resting_heart_rate' => 'nullable|integer|min:30|max:200',
            'blood_pressure' => 'nullable|string|max:255',
            'membership_start_date' => 'required|date',
            'membership_end_date' => 'nullable|date|after_or_equal:membership_start_date',
            'gender' => 'required|string',
            'status' => 'required|string',
            'health_conditions' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        $data['coach_id'] =  Auth('coach')->user()->id ;

        TraineeProfile::create($data);

        return redirect()->route('coach.trainees-profile.index')->with('success', __('models.added_successfully'));
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = TraineeProfile::find($id);
        return view('coach-dashboard.trainee_profile.show', compact("data"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = TraineeProfile::find($id);
        $categories = Category::all();
        $packages = Package::all();
        return view('coach-dashboard.trainee_profile.edit', compact("data", "categories", "packages"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'age' => 'nullable|integer|min:1|max:150',
            'weight' => 'nullable|numeric|min:0|max:500',
            'height' => 'nullable|numeric|min:0|max:300',
            'bmi' => 'nullable|numeric|min:0',
            'body_fat_percentage' => 'nullable|numeric|min:0|max:100',
            'body_water_percentage' => 'nullable|numeric|min:0|max:100',
            'muscle_mass' => 'nullable|numeric|min:0|max:500',
            'resting_heart_rate' => 'nullable|integer|min:30|max:200',
            'blood_pressure' => 'nullable|string|max:255',
            'membership_start_date' => 'required|date',
            'membership_end_date' => 'nullable|date|after_or_equal:membership_start_date',
            'gender' => 'required|string',
            'status' => 'required|string',
            'health_conditions' => 'nullable|string|max:255',
        ]);

        $traineeprofile = TraineeProfile::find($id);

        $data = $request->except('img');

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "trainees");
        }

        $traineeprofile->update($data);

        return redirect()->route('coach.trainees-profile.index')->with('success', __('models.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $traineeprofile = TraineeProfile::find($id);
        $traineeprofile->delete();
        return redirect()->route('coach.trainees-profile.index')->with('success', __('models.deleted_successfully'));
    }


    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        // return response()->json(['success' => true ,"ids"=> $ids]);
        foreach ($ids as $id) {
            $trainee = TraineeProfile::find($id);
            if ($trainee) {
                $trainee->delete();
            }
        }
        return response()->json(['success' => true]);
    }
    public function toggleActivation(Request $request)
    {
        $traineeprofile = TraineeProfile::findOrFail($request->id);
        $traineeprofile->is_active = !$traineeprofile->is_active;
        $traineeprofile->save();

        return response()->json(['success' => true, 'is_active' => $traineeprofile->is_active]);
    }

}
