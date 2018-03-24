@extends('layout')
@section('content')


    <h2>Nota</h2>
    <p class="small">Categoria:</p>
        <a class="label label-info">{{ $note->category->name }}</a>
    <br><br>
    <div class="list-group-item">
    {{ $note->note }}
    </div>
    <br>
    <!--<a href=" {{ url('download/'.$note->image)}}">{{$note->image}}</a>-->
    <br><br>
    <a href="{{ url('notes') }}"><button class="btn btn-info" type="button">Volver atras</button></a>
    <a href="{{ url('notes/upt/'.$note->id)}}"><button class="btn btn-warning" type="button">Modificar</button></a>

@endsection