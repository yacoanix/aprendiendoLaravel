<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Note;
use App\Category;

use App\Http\Requests;

class NotesController extends Controller
{
    public function redimensionar($rutaImagenOriginal){
        //Ruta de la imagen original

        //Creamos una variable imagen a partir de la imagen original
        $img_original = imagecreatefromjpeg($rutaImagenOriginal);

        //Se define el maximo ancho o alto que tendra la imagen final
        $max_ancho = 200;
        $max_alto = 200;

        //Ancho y alto de la imagen original
        list($ancho,$alto)=getimagesize($rutaImagenOriginal);

        //Se calcula ancho y alto de la imagen final
        $x_ratio = $max_ancho / $ancho;
        $y_ratio = $max_alto / $alto;

        //Si el ancho y el alto de la imagen no superan los maximos,
        //ancho final y alto final son los que tiene actualmente
        if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){//Si ancho
            $ancho_final = $ancho;
            $alto_final = $alto;
        }
        /*
         * si proporcion horizontal*alto mayor que el alto maximo,
         * alto final es alto por la proporcion horizontal
         * es decir, le quitamos al alto, la misma proporcion que
         * le quitamos al alto
         *
        */
        elseif (($x_ratio * $alto) < $max_alto){
            $alto_final = ceil($x_ratio * $alto);
            $ancho_final = $max_ancho;
        }
        /*
         * Igual que antes pero a la inversa
        */
        else{
            $ancho_final = ceil($y_ratio * $ancho);
            $alto_final = $max_alto;
        }

        //Creamos una imagen en blanco de tamaño $ancho_final  por $alto_final .
        $tmp=imagecreatetruecolor($ancho_final,$alto_final);

        //Copiamos $img_original sobre la imagen que acabamos de crear en blanco ($tmp)
        imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);

        //Se destruye variable $img_original para liberar memoria
        imagedestroy($img_original);

        //Definimos la calidad de la imagen final
        $calidad=95;

        //Se crea la imagen final en el directorio indicado
        imagejpeg($tmp,$rutaImagenOriginal,$calidad);

        /* SI QUEREMOS MOSTRAR LA IMAGEN EN EL NAVEGADOR
         *
         * descomentamos las lineas 64 ( Header("Content-type: image/jpeg"); ) y 65 ( imagejpeg($tmp); )
         * y comentamos la linea 57 ( imagejpeg($tmp,"./imagen/retoque.jpg",$calidad); )
         */
        //Header("Content-type: image/jpeg");
        //imagejpeg($tmp);

    }

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
        $id=\Auth::user()->id;
        $image = $request->file('imagen');


        if($image != null) {
            $nombre = $image->getClientOriginalName(); //IMPORTANTE UNO
            $datos = array_add($datos, 'image', $nombre);
            \Storage::disk('local')->put($nombre, \File::get($image)); //IMPORTANTE 2 Y CONFIG/FYLESISTEM AÑADIR LOCAL
            //https://styde.net/sistema-de-archivos-y-almacenamiento-en-laravel-5/
            $url=storage_path().'/'.$nombre;
            $this->redimensionar($url);
        }


        $datos = array_add($datos, 'user_id', $id); //AÑADE A DATOS LA ID USUARIO
        Note::create($datos);


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
        $img = $note->image;
        if($img != null) {
            \Storage::delete($img);
        }
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
        $image = request()->file('imagen');
        if($image != null){
            $nombre = $image->getClientOriginalName(); //IMPORTANTE UNO
            $note = Note::find($id);
            if($note->image != $nombre)
            {
                \Storage::delete($note->image);
                \Storage::disk('local')->put($nombre, \File::get($image));
                Note::where('id',$id)->update(['image'=> $nombre ]);
                $url=storage_path().'/'.$nombre;
                $this->redimensionar($url);
            }
        }
        Note::where('id',$id)->update(['note'=> $notas]);
        Note::where('id',$id)->update(['category_id'=> $categ ]);
        $note=Note::findOrFail($id);
        return view('notes/details',compact('note'));
    }

    public function devolvImg($archivo)
    {
        $public_path = storage_path();
        $url = $public_path.'/'.$archivo;

        //verificamos si el archivo existe y lo retornamos
        if (\Storage::exists($archivo))
        {
            return response()->download($url);
        }
        //si no se encuentra lanzamos un error 404.
        abort(404);
    }

}
