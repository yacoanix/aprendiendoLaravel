@extends('layout')
@section('content')

    <h1 style="margin-left:1.5%">Modifica la nota</h1>
    @include('partials/errors')
    <form method="POST" action="{{ url('update/'.$note->id) }}" class="form" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="container">
            <textarea class="form-control" rows="5" style="width:70%" name="note">{{ old('note') }}{{ $note->note }}</textarea>
            <br>
            <select name="category_id">
            @foreach($category as $categ)
                @if($categ->id == $note->category_id)
                    <option value="{{$categ->id}}" selected>{{$categ->name}}</option>
                @else
                    <option value="{{$categ->id}}">{{$categ->name}}</option>
                @endif
            @endforeach
            </select>
            <br><br>
            @if($note->image == null)
                <label>Imagen a subir (opcional):</label>
            @else
                <label>Cambiar imagen (opcional):</label>
            @endif
            <input name="imagen" type="file" accept=".jpg, .jpeg, .png">
        </div>
        <br><br>
        <a href="{{ url('notes/look/'.$note->id) }}"><button type="button" style="margin-left:1.5%" class="btn btn-danger">Cancelar</button></a>
        <button type="submit" class="btn btn-primary">Modificar</button>
    </form>
    <br>
@endsection