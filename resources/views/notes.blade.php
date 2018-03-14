@extends('layout')
@section('content')



<h1>Notes</h1>
<ul>
    @foreach ($notes as $note)
        <li>

            @if(strlen($note->note)>30)

                {{ substr($note->note, 0, 30) }}...

            @else

                {{ $note->note }}

            @endif

        </li>
    <!--   <li>{!! $note->note !!}</li>-->
    @endforeach
</ul>

<form method="POST">
{!! csrf_field() !!}
<!--es lo mismo de lo de arriba-->
<!-- <input type="hidden" name="_token" value="{{ csrf_token() }}";/> -->
    <textarea></textarea>
    <button type="submit">Crear nota</button>
</form>
@endsection