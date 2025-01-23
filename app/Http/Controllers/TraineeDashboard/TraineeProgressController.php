<?php

namespace App\Http\Controllers\TraineeDashboard;

use Illuminate\Http\Request;
use App\Models\TraineeProgress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TraineeProgressController extends Controller
{
    public function index()
    {
        $progress = TraineeProgress::where('trainee_id', Auth::guard('trainee')->id())->get();

        return view('trainee-dashboard.progress.index', compact('progress'));
    }


    public function create()
    {
        return view('trainee-dashboard.progress.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'img' => 'nullable|image',
            'upload_date' => 'required|date',
        ]);

        $traineeId = auth('trainee')->user()->id;

        $data = $request->except('img');

        $data['trainee_id'] = $traineeId ;

        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), "progress");
        }

        TraineeProgress::create($data);

        return redirect()->route('trainee.progress.index')->with('success', __('models.created_successfully'));
    }

    public function edit(string $id)
    {
        $progress = TraineeProgress::find($id);

        return view('trainee-dashboard.progress.edit', compact("progress"));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'img' => 'nullable|image',
            'upload_date' => 'required|date',
        ]);


        $traineeId = auth('trainee')->user()->id;

        // Find the existing progress record
        $progress = TraineeProgress::where('id', $id)
        ->where('trainee_id', $traineeId)
        ->firstOrFail();

        $data = $request->except('img');

        // Ensure the `trainee_id` is not changed
        $data['trainee_id'] = $traineeId;

        if ($request->hasFile('img')) {
            // Optionally delete the old image if needed
            // Storage::delete($progress->img);

            $data['img'] = UploadImage($request->file('img'), "progress");
        }

        // Update the progress record with the new data
        $progress->update($data);

        return redirect()->route('trainee.progress.index')->with('success', __('models.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $traineeId = auth('trainee')->user()->id;

        // Find the existing progress record
        $progress = TraineeProgress::where('id', $id)
            ->where('trainee_id', $traineeId)
            ->firstOrFail();

        // Optionally delete the associated image from storage
        // Storage::delete($progress->img);

        // Delete the progress record
        $progress->delete();

        return redirect()->route('trainee.progress.index')->with('success', 'Progress deleted successfully.');
    }



}
