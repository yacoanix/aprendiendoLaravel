@extends('layout')
@section('content')


<h1>Notes</h1>
<p>
    <!-- <a href="{{ url('notes/create') }}">Añade una nota</a> -->
</p>
<ul class="list-group">
    @foreach ($notes as $note)
        <li class="list-group-item">
            <span class="label label-info">{{ $note->category->name }}</span>
            @if(strlen($note->note)>100)
            {{ substr($note->note, 0, 100) }}...
            @else
            {{ $note->note }}
            @endif
            <span style="float:right"><a href="{{ 'notes/del/'.$note->id}}"><button class="btn btn-danger btn-xs" type="button">Eliminar</button></a></span>
            <span style="float:right;margin-right:10px"><a href="{{ url('notes/look/'.$note->id)}}" ><button class="btn btn-info btn-xs" type="button">Ver nota</button></a></span>
        </li>
    @endforeach
</ul>
{!! $notes->render() !!}
@endsection