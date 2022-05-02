@extends('template')

@section('title')
    Créer un livre
@endsection

@section('content')
    <div class="container">
        <form class="form" action="{{ route('livre.creerSubmit') }}" method="post">
            <h3>Créer un livre</h3>
            @csrf
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" name="isbn" class="form-control @error('isbn') is-invalid @enderror" value="{{ old('isbn') }}">
                @if($errors->has('isbn'))
                    <div class="error">{{ $errors->first('isbn') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                @if($errors->has('title'))
                    <div class="error">{{ $errors->first('title') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="authors">Auteur</label>
                <input type="text" name="authors" class="form-control @error('authors') is-invalid @enderror" value="{{ old('authors') }}">
                @if($errors->has('authors'))
                    <div class="error">{{ $errors->first('authors') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="editor">Éditeur</label>
                <input type="text" name="editor" class="form-control @error('editor') is-invalid @enderror" value="{{ old('editor') }}">
                @if($errors->has('editor'))
                    <div class="error">{{ $errors->first('editor') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="editor">Catégorie</label>
                <select name="category" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="summary">Sommaire</label>
                <textarea name="summary" class="form-control @error('summary') is-invalid @enderror">{{ old('summary') }}</textarea>
                @if($errors->has('summary'))
                    <div class="error">{{ $errors->first('summary') }}</div>
                @endif
            </div>
            <div class="row d-flex justify-content-center">
                <input type="submit" name="submit" class="btn btn-info btn-md" value="Créer"/>
            </div>
        </form>
    </div>
@endsection
