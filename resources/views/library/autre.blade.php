@extends('template')

@section('title')
    Bibliothèque principale
@endsection

@section('content')
    <div class="row d-flex justify-content-center">
        <h3>Bibliothèque de {{ $user->name }} : {{ $library->name }}</h3>
    </div>
    <div class="container p-3 mb-2 bg-light text-dark">
        <form class="form" action="{{ url('bibliotheque/autreTri/' . $user->id) }}" method="get">
            @csrf
            <div class="row">
                <div class="form-group col">
                    <label for="isbn">ISBN</label>
                    <input type="text" name="isbn" class="form-control" value="{{ $data['isbn'] ?? '' }}">
                </div>
                <div class="form-group col">
                    <label for="title">Titre</label>
                    <input type="text" name="title" class="form-control" value="{{ $data['title'] ?? '' }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="authors">Auteur</label>
                    <input type="text" name="authors" class="form-control" value="{{ $data['authors'] ?? '' }}">
                </div>
                <div class="form-group col">
                    <label for="editor">Éditeur</label>
                    <input type="text" name="editor" class="form-control" value="{{ $data['editor'] ?? '' }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="category">Catégorie</label>
                    <select name="category" class="form-control">
                        <option value=""></option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <input type="submit" name="submit" class="btn btn-info btn-md" value="Trier"/>
            </div>
        </form>
    </div>
    <div class="d-flex justify-content-center">
        {{ $books->links() }}
    </div>
    @if(!$books->isEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Éditeur</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Opérations</th>
                </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr>
                    <td scope="row">{{ $book->id }}</td>
                    <td scope="row">{{ $book->isbn }}</td>
                    <td scope="row">{{ $book->title }}</td>
                    <td scope="row">{{ $book->authors }}</td>
                    <td scope="row">{{ $book->editor }}</td>
                    <td scope="row">{{ $book->category->label }}</td>
                    <td scope="row">
                        <a href="{{ url('livre/consulter/' . $book->id) }}" class="row">Consulter</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="container">
            Désolé, aucun livre n'a été trouvé.
        </div>
    @endif
    <div class="d-flex justify-content-center">
        {{ $books->links() }}
    </div>
@endsection
