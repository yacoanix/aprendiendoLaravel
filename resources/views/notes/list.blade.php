@extends('layout')
@section('content')


<h1>Notes</h1>
<p>
    <a href="{{ url('notes/create') }}">Añade una nota</a>
</p>
<ul>
    @foreach ($notes as $note)
        <li>
            {{ $note->note }}

        </li>
    @endforeach
</ul>

@endsection