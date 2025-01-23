<?php

namespace App\Http\Controllers\CoachDashboard;

use App\Models\Trainee;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $data = Category::get();
        return view("coach-dashboard.categories.index", compact("data"));
    }


    public function create()
    {
        // Get the currently authenticated coach
        $coach = Auth::guard('coach')->user();

        // Fetch trainees belonging to the current coach
        $trainees = Trainee::where('coach_id', $coach->id)->get();
        $categories = Category::where('type', 'training')->get();
        return view("coach-dashboard.categories.create" , compact("categories", "trainees"));

    }

    public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'desc' => 'nullable|string',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'type' => 'required|string|in:category,training',
        'trainee_ids' => 'nullable|array',
        'trainee_ids.*' => 'exists:trainees,id',
    ]);

    // Prepare the data for creation
    $data = $request->except('img');

    // Handle image upload if file is provided
    if ($request->hasFile('img')) {
        $data['image'] = $request->file('img')->store('images');
    }

    // Create the category
    $category = Category::create($data);

    // If trainee_ids are provided, associate them with the category
    if ($request->has('trainee_ids')) {
        $category->trainees()->sync($request->input('trainee_ids'));
    }

    return redirect()->route('coach.categories.index')->with('success', __('models.added_successfully'));
}






    public function show(string $id)
    {
        $data = Category::find($id);

        if (!$data) {
            return redirect()->route('coach.categories.index')->with('error', 'Category not found.');
        }

        $trainings = $data->trainings; // Get the associated trainings

        return view('coach-dashboard.categories.show', compact('data', 'trainings'));
    }



    public function edit($id)
    {
        $coach = Auth::guard('coach')->user();

        // Fetch trainees belonging to the current coach
        $trainees = Trainee::where('coach_id', $coach->id)->get();
        $data = Category::findOrFail($id);
        return view("coach-dashboard.categories.edit", compact("data", "trainees"));
    }


    public function update(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'desc' => 'nullable|string',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'type' => 'required|string|in:category,training',
        'trainee_ids' => 'nullable|array',
        'trainee_ids.*' => 'exists:trainees,id',
    ]);

    // Find the category by ID
    $category = Category::findOrFail($id);

    // Prepare the data for update
    $data = $request->except('img');

    // Handle image upload if a new file is provided
    if ($request->hasFile('img')) {
        // Store the new image and update the data array
        $data['image'] = $request->file('img')->store('images'); // Adjusted to use Laravel's store method
    }

    // Update the category with the new data
    $category->update($data);

    // Manage trainees if they are selected
    if ($request->has('trainee_ids')) {
        // Check if you are using a pivot table or direct association
        // For a pivot table (many-to-many relationship)
        $category->trainees()->sync($request->input('trainee_ids'));

        // For a one-to-many relationship
        // If the relationship is one-to-many, you might need to update records or handle differently
        // Example: Set the category_id for trainees if the relationship is one-to-many
        // Trainee::whereIn('id', $request->input('trainee_ids'))->update(['category_id' => $category->id]);
    }

    return redirect()->route('coach.categories.index')->with('success', __('models.edited_successfully'));
}






    public function destroy($id)
    {
        $admin = Category::find($id);
        $admin->delete();
        return redirect(route('coach.categories.index'))->with('success', __('models.deleted_successfully'));

    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        // return response()->json(['success' => true ,"ids"=> $ids]);
        foreach ($ids as $id) {
            $admin = Category::find($id);
            if ($admin) {
                $admin->delete();
            }
        }
        return response()->json(['success' => true]);
    }
    public function toggleActivation(Request $request)
    {
        $admin = Category::findOrFail($request->id);
        $admin->is_active = !$admin->is_active;
        $admin->save();

        return response()->json(['success' => true, 'is_active' => $admin->is_active]);
    }

}
