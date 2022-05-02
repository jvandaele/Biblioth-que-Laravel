@extends('template')

@section('title')
    Consulter un livre
@endsection

@section('content')
    <div class="container">
        <h3>{{ $book->title }}</h3>
        <div class="col">
            <div class="row">
                <b>Auteur </b> : {{ $book->authors }}
            </div>
            <div class="row">
                <b>Editeur </b> : {{ $book->editor }}
            </div>
            <div class="row">
                <b>Catégorie </b>: {{ $book->category->label }}
            </div>
            <div class="row">
                <b>ISBN </b>: {{ $book->isbn }}
            </div>
            <div class="row">
                <p>{{ $book->summary }}</p>
            </div>
        </div>
    </div>
    <div class="container">
        @if(!empty($notes))
            @foreach($notes as $note)
                <div class="container m-2 bg-light border" style="border-radius: 5px;">
                    <div class="row d-flex justify-content-center p-2">
                        <div class="col d-flex justify-content-center"><b>Utilisateur : {{ $note['user']->name }}</b></div>
                        <div class="col d-flex justify-content-center"><b>Note : {{ $note['note']->note }}/5</b></div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="row p-2">
                        @if($note['note']->commentaire == "")
                            <i>L'utilisateur n'a pas laissé de commentaire.</i>
                        @else
                            {{ $note['note']->commentaire }}
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <i>Ce livre n'a jamais été noté.</i>
        @endif
    </div>
@endsection
