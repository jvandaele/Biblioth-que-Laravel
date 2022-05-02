<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Comfortaa', cursive;
        }

        tr.unread td {
            font-weight: bold;
        }

        tr.unread td a {
            font-weight: bold;
        }

        thead tr:nth-child(1) th {
            background: white;
            position: sticky;
            top: 0;
            z-index: 10;
        }
    </style>
</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    @if (Auth::check())
        <h1 class="my-0 mr-md-auto font-weight-normal">
            <img src="{{ url('/img/book-stack.svg')  }}" style="height: 1em;" alt="icone"/> Les bibliothèques incroyables
        </h1>
        <nav class="my-2 my-md-0 mr-md-3">
            <span class="dropdown">
                <a href="#" class="p-2 text-dark" type="button" id="dropdown-account-button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false" style="font-size: 2.5rem;"><i class="fa fa-book"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-account-button">
                    <a class="dropdown-item text-dark" href="{{ route('bibliotheque.principale') }}" title="Bibliothèque principale"><i class="fa fa-book"></i>
                        Bibliothèque principale</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-dark" href="{{ route('bibliotheque.verification') }}" title="Votre bibliothèque"><i class="fa fa-book"></i>
                        Votre bibliothèque</a>
                    <a class="dropdown-item text-dark" href="{{ route('bibliotheque.listeAmis') }}" title="Bibliothèques de vos amis"><i class="fa fa-book"></i>
                        Bibliothèques de vos amis</a>
                </div>
            </span>
            <span class="dropdown">
                <a href="#" class="p-2 text-dark" type="button" id="dropdown-account-button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false" style="font-size: 2.5rem;"><i
                        class="far fa-user-circle"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-account-button">
                    <a class="dropdown-item text-dark" href="{{ route('profile') }}" title="Profil"><i
                            class="far fa-id-card"></i> Profil</a>
                    <a class="dropdown-item text-dark" href="{{ route('profile.password') }}" title="Mot de passe"><i
                            class="fa fa-key"></i> Changer votre mot de passe</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-dark" href="{{ route('ami.liste') }}" title="Ajouter des amis"><i
                            class="far fa-id-card"></i> Liste des utilisateurs</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-dark" href="{{ route('logout') }}" title="Déconnexion"><i
                            class="fa fa-power-off"></i> Se déconnecter</a>
                </div>
            </span>
        </nav>
    @endif
</div>
<div class="container">
    @yield('content')
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

@yield('scripts')
</body>
</html>
