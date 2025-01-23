<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $data = AboutUs::with('features')->get();
        return view('dashboard.about-us.index', compact('data'));
    }

    public function create()
    {
        return view('dashboard.about-us.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'video' => 'required|file',
            'features' => 'required|array',
            'features.*.name' => 'required|string',
            'features.*.rate' => 'required|string',
        ]);


        // Handle the video upload
        if($request->hasFile('video'))
        {
            $videoPath = UploadVideo($request->file('video'), "Video");
        }
        // Create the AboutUs entry
        $aboutus = AboutUs::create([
            'description' => $request->input('description'),
            'video' => $videoPath,
        ]);

        // Create the features associated with this AboutUs entry
        foreach ($request->input('features') as $feature) {
            $aboutus->features()->create([
                'name' => $feature['name'],
                'rate' => $feature['rate'],

            ]);
        }

        return redirect()->route('about-us.index')->with('success', __('models.added_successfully'));
    }

    public function show($id)
    {
        $aboutus = AboutUs::with('features')->findOrFail($id);
        return view('dashboard.about-us.show', compact('aboutus'));
    }

    public function edit($id)
    {
        $aboutus = AboutUs::with('features')->findOrFail($id);
        return view('dashboard.about-us.edit', compact('aboutus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string',
            'video' => 'nullable|file',  // Make video optional during update
            'features' => 'required|array',
            'features.*.name' => 'required|string',
            'features.*.rate' => 'required|string',
        ]);

        $aboutus = AboutUs::with('features')->findOrFail($id);

        $data = $request->except('video');

        if ($request->hasFile('video')) {
            // Assuming UploadVideo is a helper function that uploads the video and returns the path
            $data['video'] = UploadVideo($request->file('video'), "Video");

            // Optionally delete the old video from storage
            // Storage::delete($aboutus->video);
        } else {
            // Preserve the existing video if no new file is uploaded
            $data['video'] = $aboutus->video;
        }


        $aboutus->update([
            'description' => $request->description,
            'video' => $data['video'],
        ]);

        // Delete old features
        $aboutus->features()->delete();

        // Recreate the features
        foreach ($request->features as $feature) {
            $aboutus->features()->create([
                'name' => $feature['name'],
                'rate' => $feature['rate'],

            ]);
        }

        return redirect()->route('about-us.index')->with('success', __('models.updated_successfully'));
    }

    public function destroy($id)
{
    $aboutus = AboutUs::findOrFail($id);

    // Optionally delete the video from storage if needed
    // Storage::delete($aboutus->video);

    // Delete associated features
    $aboutus->features()->delete();

    // Delete the AboutUs record
    $aboutus->delete();

    return redirect()->route('about-us.index')->with('success', __('models.deleted_successfully'));
}





}
