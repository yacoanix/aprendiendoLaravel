@extends('layout')
@section('content')

    <h1 style="margin-left:1.5%">Crear una nota</h1>
    @include('partials/errors')
    <form method="POST" action="{{ url('notes') }}" class="form">
        {!! csrf_field() !!}
        <div class="container">
            <textarea class="form-control" rows="5" style="width:70%" name="note">{{ old('note') }}</textarea>
            <br>
            <select name="category_id">
                @foreach($category as $categ)
                <option value="{{$categ->id}}">{{$categ->name}}</option>
                @endforeach
            </select>
        </div>
        <br><br>
        <button type="submit" style="margin-left:1.5%" class="btn btn-primary">Crear nota</button>
    </form>
    <br>

@endsection