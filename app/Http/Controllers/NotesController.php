<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Note;

use App\Http\Requests;

class NotesController extends Controller
{
    public function listNotes()
    {
        $notes = Note::paginate(20);

        return view('notes/list', compact('notes'));
    }


    public function create()
    {
        return view('notes/create');
    }


    public function store()
    {
        //return request()->all(); para todos
        //return request()->get('note'); para uno solo
        //return request()->only(['note']); //varios
        $this->validate(request(),
            [
               'note'=>['required','max:200']
            ]);
        $datos=request()->all();
        Note::create($datos);
        return redirect()->to('notes');

    }


    public function show($note){
        $note=Note::findOrFail($note);
        return view('notes/details',compact('note'));
    }


}
