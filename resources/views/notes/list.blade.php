@extends('layout')
@section('content')


<h1>Notes</h1>
<p>
    <a href="{{ url('notes/create') }}">Añade una nota</a>
</p>
<ul class="list-group">
    @foreach ($notes as $note)
        <li class="list-group-item">
            @if($note->category)
            <span class="label label-info">{{ $note->category->name }}</span>
            @else
                <span class="label label-info">Default</span>
            @endif
            @if(strlen($note->note)>30)
                {{ substr($note->note, 0, 30) }}...
            @else
                {{ $note->note }}
            @endif
        </li>
    @endforeach
</ul>
{!! $notes->render() !!}
@endsection