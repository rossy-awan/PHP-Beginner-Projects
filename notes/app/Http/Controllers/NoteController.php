<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function list()
    {
        return response()->json(Note::latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:50',
            'content' => 'required|string|max:20000',
        ]);
        $data['color'] = '#252526';
        $note = Note::create($data);
        return response()->json($note, 201);
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return response()->json(['status' => 'ok']);
    }
}
