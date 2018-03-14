@if(! $errors->isEmpty())
    <div class="alert alert-danger">
        <p><strong>FALLO</strong></p>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif