<?php

namespace App\Http\Controllers\ClubDashboard;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackageController extends Controller

{
    public function index()
    {
        $data = Package::with('features')->get();
        return view('club-dashboard.packages.index', compact('data'));
    }

    public function create()
    {
        return view('club-dashboard.packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'desc' => 'nullable|string',
            'price' => 'required|numeric',
            'features' => 'required|array',
            'features.*.name' => 'required|string',
        ]);

        // Create the package
        $package = Package::create([
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
            'price' => $request->input('price'),
            'time' => $request->input('time')
        ]);

        // Create the features
        foreach ($request->input('features') as $feature) {
            $package->features()->create([
                'name' => $feature['name'],
            ]);
        }

        return redirect()->route('club.packages.index');
    }

    public function show(Package $package)
    {
        return view('club-dashboard.packages.show', compact('package'));
    }

    public function edit(Package $package)
    {
        return view('club-dashboard.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'price' => 'required|numeric',
            'features.*.name' => 'required|string|max:255',
        ]);

        $package->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'price' => $request->price,
        ]);

        $package->features()->delete();

        foreach ($request->features as $feature) {
            $package->features()->create($feature);
        }

        return redirect()->route('club.packages.index')->with('success', 'Package updated successfully.');
    }


    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('club.packages.index');
    }


    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        // return response()->json(['success' => true ,"ids"=> $ids]);
        foreach ($ids as $id) {
            $admin = Package::find($id);
            if ($admin) {
                $admin->delete();
            }
        }
        return response()->json(['success' => true]);
    }
}
