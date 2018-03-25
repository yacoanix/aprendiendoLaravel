@extends('layout')
@section('content')

    <h1 style="margin-left:1.5%">Crear una nota</h1>
    @include('partials/errors')
    <form method="POST" action="{{ url('notes') }}" class="form" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="container">
            <textarea class="form-control" rows="5" style="width:70%" name="note">{{ old('note') }}</textarea>
            <br>
            <div>
                <span>
            <label>Categoria:</label>
            <select name="category_id">
                @foreach($category as $categ)
                <option value="{{$categ->id}}">{{$categ->name}}</option>
                @endforeach
            </select>
                </span>
                <br><br>
                <span>
            <label>Imagen a subir (opcional):</label>
            <input name="imagen" type="file" accept=".jpg, .jpeg">
                </span>
            </div>
        </div>
        <br><br>
        <button type="submit" style="margin-left:1.5%" class="btn btn-primary">Crear nota</button>
    </form>
    <br>
@endsection