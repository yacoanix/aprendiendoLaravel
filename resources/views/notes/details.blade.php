@extends('layout')
@section('content')


    <h2>Nota</h2>
    <p class="small">Categoria:</p>
        <a class="label label-info">{{ $note->category->name }}</a>
    <br><br>
    <div class="list-group-item" style="width:75%;float:left;">
    {{ $note->note }}
    </div>
    @if($note->image != null)
    <div class="list-group-item" style="width:24%; float:right;text-align: center;">
        <img style="margin-left: auto;margin-right: auto;display: block;" src={{ asset('images/'.$note->image) }}>
        <br>
        <a href=" {{ url('download/'.$note->image)}}">{{$note->image}}</a>
    </div>
    <br><br>
    @endif
    <br><br><br><br>
    <div>
    <a href="{{ url('notes') }}"><button class="btn btn-info" type="button">Volver atras</button></a>
    <a href="{{ url('notes/upt/'.$note->id)}}"><button class="btn btn-warning" type="button">Modificar</button></a>
    <br><br>
    </div>
@endsection