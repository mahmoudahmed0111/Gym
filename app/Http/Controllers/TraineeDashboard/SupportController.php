<?php

namespace App\Http\Controllers\TraineeDashboard;

use App\Models\Support;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trainee;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("trainee-dashboard.support");
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);
        $message = $validated['message'];
        $support =  Support::create([
            'message' => $message,
            'owner_type' => get_class(Trainee::first()),
            'owner_id' => auth("trainee")->user()->id,
        ]);

        return redirect()->back()->with('success', __('models.added_successfully'));

    }
}
