<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Auth::user()->notes;
        return sendResponse(200,"Notes retrieved successfully", $notes);
    }


    public function store(Request $request)
    {

        $validator=Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
        ]);
        if($validator->fails()){
            return sendResponse(400 ,'Validation Error.', $validator->errors());
        }
        $notes=Auth::user()->notes()->create($request->all());
        return sendResponse(200,"Notes created successfully", $notes);
    }

    public function show(Note $note)
    {
        return sendResponse(200,"Note retrieved successfully", $note);
    }


    public function update(Request $request, Note $note)
    {
        $validator=Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
        ]);
        if($validator->fails()){
            return sendResponse(400 ,'Validation Error.', $validator->errors());
        }
        $note->update($request->all());
        return sendResponse(200,"Note updated successfully", $note);
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return sendResponse(200,"Notes deleted successfully");
    }
}
