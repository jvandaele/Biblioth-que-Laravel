@extends('template')

@section('title')
    Liste des utilisateurs
@endsection

@section('content')
    <div class="row d-flex justify-content-center">
        <h3>Liste des utilisateurs</h3>
    </div>
    <div class="container m-3">
        Ici, vous pouvez ajouter ou retirer des amis à votre liste d'amis !</br>
        Vos amis peuvent avoir accès à votre bibliothèque !
    </div>
    @if($pasDeBibliotheque)
        <div class="container">
            Désolé, vous devez d'abord créer votre bibliothèque avant de pouvoir ajouter des amis y ayant accès.
        </div>
    @else
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
        @if(!$users->isEmpty())
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Opérations</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    @if($user->id != $userAuth)
                        <tr>
                            <td scope="row">{{ $user->name }}</td>
                            <td scope="row">
                                <?php $verif = false; ?>
                                @foreach($amis as $ami)
                                    @if($ami->id == $user->id)
                                        <?php $verif = true; ?>
                                    @endif
                                @endforeach
                                <?php
                                if($verif){
                                    ?>
                                    <form action="{{ route('ami.retirer') }}" method="post" class="row">
                                        @csrf
                                        <a href="javascript:;" onclick="parentNode.submit();">Retirer</a>
                                        <input type="hidden" name="id" value="{{ $user->id }}"/>
                                    </form>
                                    <?php
                                }
                                else{
                                    ?>
                                    <form action="{{ route('ami.ajouter') }}" method="post" class="row">
                                        @csrf
                                        <a href="javascript:;" onclick="parentNode.submit();">Ajouter</a>
                                        <input type="hidden" name="id" value="{{ $user->id }}"/>
                                    </form>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        @else
            <div class="container">
                Désolé, aucun utilisateur ne faisant pas partie de votre liste d'amis n'a été trouvé.
            </div>
        @endif
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    @endif
@endsection
