@extends('template')

@section('title')
    Connexion
@endsection

@section('content')
    <div class="d-flex flex-row justify-content-center align-items-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                <form class="form" action="{{ route('login.submit') }}" method="post">
                    @csrf
                    <h3 class="text-center text-info">Login</h3>
                    <br/><br/>
                    <div class="form-group">
                        <label for="email" class="text-info">Email:</label><br>
                        <input type="email" name="email" id="email" class="form-control  @error('email') is-invalid @enderror"/>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-info">Password:</label><br>
                        <input type="password" name="password" id="password" class="form-control  @error('password') is-invalid @enderror"/>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <br/><br/>
                    <div class="d-flex flex-row justify-content-between justify-content-center">
                        <input type="submit" name="submit" class="btn btn-info btn-md" value="submit"/>
                        <a class="btn btn-link btn-md" href="{{ route('login.register') }}">Créer un compte</a>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection
