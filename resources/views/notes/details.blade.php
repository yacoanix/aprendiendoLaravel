@extends('layout')
@section('content')


    <h2>Nota</h2>
    <p class="small">Categoria:</p>
    @if($note->category)
        <a class="label label-info">{{ $note->category->name }}</a>
    @else
        <a class="label label-info">Default</a>
    @endif
    <br><br>
    {{ $note->note }}
    <br><br>
    <a href="{{ url('notes') }}">Ver todas las notas</a>

@endsection