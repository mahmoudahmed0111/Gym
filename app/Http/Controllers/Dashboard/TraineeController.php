<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Package;
use App\Models\Trainee;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coaching\Coach;

class TraineeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Trainee::all();
        return view('dashboard.trainees.index', compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        $packages = Package::all();
        $coaches = Coach::all();
        return view('dashboard.trainees.create', compact("categories", "packages", "coaches"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:trainees,email',
            'mobile' => 'required|unique:trainees,mobile',
            'password' => 'required|string|min:8',
            'category_id' => 'required|exists:categories,id', // Validate category_id
            'package_id' => 'required|exists:packages,id', // Validate package_id
            'coach_id' => 'required|exists:coaches,id', // Validate package_id
            'img' => 'nullable|image',
            'lng' => 'required',
            'lat' => 'required',
            'location' => 'required',

        ]);

        $data = $request->except('password', 'img');

        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "trainees");
        }

        Trainee::create($data);
        return redirect()->route('trainees.index')->with('success', __('models.added_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Trainee::find($id);
        $coach = $data->coach; // Get the coach

        return view("dashboard.trainees.show", compact("data", "coach"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Trainee::find($id);
        $categories = Category::all();
        $packages = Package::all();
        $coaches = Coach::all();
        return view('dashboard.trainees.edit', compact("data", "categories", "packages", "coaches"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|:trainees,email',
            'mobile' => 'required|:trainees,mobile',
            'password' => 'string|min:8',
            'category_id' => 'required|exists:categories,id', // Validate category_id
            'package_id' => 'required|exists:packages,id', // Validate package_id
            'coach_id' => 'required|exists:coaches,id', // Validate package_id
            'img' => 'nullable|image',
            'lng' => 'required',
            'lat' => 'required',
            'location' => 'required',
        ]);

        $trainee = Trainee::find($id);

        $data = $request->except('password', 'img');

        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "trainees");
        }

        $trainee->update($data);

        return redirect()->route('trainees.index')->with('success', __('models.updated_successfully'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $trainee = Trainee::find($id);

        $trainee->delete();

        return redirect()->route('trainees.index')->with('success', __('models.deleted_successfully'));
    }
    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        // return response()->json(['success' => true ,"ids"=> $ids]);
        foreach ($ids as $id) {
            $trainee = Trainee::find($id);
            if ($trainee) {
                $trainee->delete();
            }
        }
        return response()->json(['success' => true]);
    }
    public function toggleActivation(Request $request)
    {
        $trainee = Trainee::findOrFail($request->id);
        $trainee->is_active = !$trainee->is_active;
        $trainee->save();

        return response()->json(['success' => true, 'is_active' => $trainee->is_active]);
    }
}
