@extends('template')

@section('title')
    Bibliothèques de mes amis
@endsection

@section('content')
    <div class="row d-flex justify-content-center">
        <h3>Bibliothèques de mes amis</h3>
    </div>
    <div class="d-flex justify-content-center">
        {{ $libraries->links() }}
    </div>
    @if(!$libraries->isEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Opérations</th>
                </tr>
            </thead>
            <tbody>
            @foreach($libraries as $library)
                <tr>
                    <td scope="row">{{ $users[$loop->index]->name }}</td>
                    <td scope="row">
                        <a href="{{ url('bibliotheque/autre/' . $users[$loop->index]->id) }}" class="row">Consulter</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="container">
            Personne ne vous a ajouté en ami.</br>
            Vous n'avez accès à aucune autre bibliothèque que la votre.
        </div>
    @endif
    <div class="d-flex justify-content-center">
        {{ $libraries->links() }}
    </div>
@endsection
