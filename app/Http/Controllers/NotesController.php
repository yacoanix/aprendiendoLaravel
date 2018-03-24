<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Note;
use App\Category;

use App\Http\Requests;

class NotesController extends Controller
{
    public function listNotes()
    {
        $notes = Note::where('user_id',\Auth::user()->id)->orderBy('created_at', 'desc')->paginate(20);
        return view('notes/list', compact('notes'));
    }


    public function create()
    {
        $category = Category::all();
        return view('notes/create',compact('category'));
    }


    public function store(Request $request)
    {
        //return request()->all(); para todos
        //return request()->get('note'); para uno solo
        //return request()->only(['note']); //varios
        $this->validate(request(),
            [
                'note'=>['required','max:200'],
            ]);
        //$datos=request()->only(['notes']);
        $datos=request()->all();
        $image = $request->file('imagen');
        $id=\Auth::user()->id;
        $nombre = $image->getClientOriginalName(); //IMPORTANTE UNO
        $datos = array_add($datos, 'user_id', $id); //AÑADE A DATOS LA ID USUARIO
        $datos = array_add($datos, 'image', $nombre);
        Note::create($datos);

        \Storage::disk('local')->put($nombre,  \File::get($image)); //IMPORTANTE 2 Y CONFIG/FYLESISTEM AÑADIR LOCAL
        //https://styde.net/sistema-de-archivos-y-almacenamiento-en-laravel-5/

        return redirect()->to('notes');
    }

    public function show($note){
        $note=Note::findOrFail($note);
        $id=\Auth::user()->id;
        $idnot=$note->user_id;
        if($id==$idnot)
            return view('notes/details',compact('note'));
        else
            return view('notes/welcome');
    }

    public function welcome()
    {
        return view('notes/welcome');
    }

    public function delete($id)
    {
        $note = Note::find($id);
        $note->delete();
        return redirect()->to('notes');

    }

    public function pgupdate($id)
    {
        $note = Note::find($id);
        $category = Category::all();
        $id=\Auth::user()->id;
        $idnot=$note->user_id;
        if($id==$idnot)
            return view('notes/update',compact('note','category'));
        else
            return view('notes/welcome');

    }
    public function update($id){
        $this->validate(request(),
            [
                'note'=>['required','max:200']
            ]);
        $datos=request()->all();
        $notas=array_get($datos, 'note');
        $categ=array_get($datos, 'category_id');
        Note::where('id',$id)->update(['note'=> $notas]);
        Note::where('id',$id)->update(['category_id'=> $categ ]);
        $note=Note::findOrFail($id);
        return view('notes/details',compact('note'));
    }

    public function devolvImg($archivo)
    {
        $public_path = public_path();
        $url = $public_path.'/storage/'.$archivo;
        //verificamos si el archivo existe y lo retornamos
        if (\Storage::exists($archivo))
        {
            return response()->download($url);
        }
        //si no se encuentra lanzamos un error 404.
        abort(404);
    }

}
