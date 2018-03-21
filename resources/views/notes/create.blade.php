@extends('layout')
@section('content')

    <h1>Crear una nota</h1>
    @include('partials/errors')
    <form method="POST" action="{{ url('notes') }}" class="form">
        {!! csrf_field() !!}
        <textarea name="note" class="form-control">{{ old('note') }}</textarea>
        <br>
        <button type="submit" class="btn btn-primary">Crear nota</button>
    </form>
    <br>

@endsection