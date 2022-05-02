@extends('template')

@section('title')
    Nommez votre bibliothèque
@endsection

@section('content')
    <div class="container">
        <h3>Nommez votre bibliotheque</h3>
        <form class="form" action="{{ route('bibliotheque.nommer') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="editor">Nom</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('isbn') }}">
                @if($errors->has('name'))
                    <div class="error">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="row d-flex justify-content-center">
                <input type="submit" name="submit" class="btn btn-info btn-md" value="Trier"/>
            </div>
        </form>
    </div>
@endsection
