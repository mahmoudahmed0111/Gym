<?php

namespace App\Http\Controllers\VendorDashboard;

use App\Http\Controllers\Controller;

use App\Models\Partener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PartenerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parteners = Partener::all();
        // return $admins;
        return view("dashboard.partener.index", compact('parteners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Partener::all();
        // return $data ;
        return view("dashboard.partener.create", compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'sport' => 'required|string',
            'brand__name' => 'required|string',


        ]);


        Partener::create($request->all());
        Session::flash('success_message', ('login in successfully'));
        // If there are errors
        // toastr()->error('Failed to send message. Please check your inputs.');

        return redirect()->back(); // Or any redirect URL you prefer
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view("dashboard.partener.show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Partener::all();
        return view("dashboard.partener.create", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = Partener::find($id);
        $contact->delete();
        return back();
    }
}
