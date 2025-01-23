<?php

namespace App\Http\Controllers\CoachDashboard;

use App\Models\Support;
use Illuminate\Http\Request;
use App\Models\Coaching\Coach;
use App\Http\Controllers\Controller;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("coach-dashboard.support");
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);
        $message = $validated['message'];
        $support =  Support::create([
            'message' => $message,
            'owner_type' => get_class(Coach::first()),
            'owner_id' => auth("coach")->user()->id,
        ]);

        return redirect()->back()->with('success', __('models.added_successfully'));

    }
}
