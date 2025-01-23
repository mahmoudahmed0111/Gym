<?php

namespace App\Http\Controllers\ClubDashboard;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        return view("club-dashboard.support");
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);
        $message = $validated['message'];
        $support =  Support::create([
            'message' => $message,
            'owner_type' => get_class(Club::first()),
            'owner_id' => auth("club")->user()->id,
        ]);

        return redirect()->back()->with('success', __('models.added_successfully'));

    }
}
