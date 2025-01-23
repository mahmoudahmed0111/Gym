<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Contact::all();
        // return $admins;
        return view("dashboard.contacts.index", compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Contact::all();
        // return $data ;
        return view("dashboard.contacts.create", compact('data'));
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
            'msg' => 'required|string',
        ]);


        Contact::create($request->all());
        Session::flash('success_message', ('Thank you for Contacting'));
        // If there are errors
        // toastr()->error('Failed to send message. Please check your inputs.');

        return redirect()->back(); // Or any redirect URL you prefer
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view("dashboard.contacts.show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Contact::all();
        return view("dashboard.contacts.create", compact('data'));
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
        $contact = Contact::find($id);
        $contact->delete();
        return back();
    }
}
