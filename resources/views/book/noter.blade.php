@extends('template')

@section('title')
    Noter un livre
@endsection

@section('content')
    <div class="container">
        <form class="form" action="{{ route('livre.noterSubmit') }}" method="post">
            <h3>Noter le livre : {{ $book->title }}</h3>
            @csrf
            <input type="hidden" name="id" value="{{ $book->id }}">
            <div class="form-group">
                <label for="editor">Note</label>
                <select name="note" class="form-control">
                    @for($i = 1;$i<6;$i++)
                        <option value="{{ $i }}">{{ $i }}/5</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="commentaire">Commentaire</label>
                <textarea name="commentaire" class="form-control"></textarea>
            </div>
            <div class="row d-flex justify-content-center">
                <input type="submit" name="submit" class="btn btn-info btn-md" value="Noter"/>
            </div>
        </form>
    </div>
@endsection
