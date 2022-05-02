<?php
/** @var \App\Models\User $user */
?>

@extends('template')

@section('title')
    @if ($user->id)
        Modification de {{ $user->name }}
    @else
        Créer un nouveau compte
    @endif
@endsection

@section('content')
    @if ($user->id)
        <h2>Modification de {{ $user->name }}</h2>
    @else
        <h2>Créer un nouveau compte</h2>
    @endif

    <form action="{{ route('login.register-submit', ['id' => $user->id]) }}" method="post">
        @csrf

        <input type="hidden" name="idUser" value="{{ $user->id }}"/>

        <div class="form-group">
            <label for="user-name">Name *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="user-name"
                   value="{{ old('name', $user->name) }}" required/>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="user-email">Email *</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="user-email"
                   value="{{ old('email', $user->email) }}" required/>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="user-password">Mot de passe *</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="user-password"
                   value="{{ old('password') }}" required/>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="user-password_confirmation">Confirmation *</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                   name="password_confirmation" id="user-password_confirmation" value="{{ old('password_confirmation') }}" required/>
            @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <a href="{{ route('login') }}" class="btn btn-outline-secondary"><i class="fa fa-angle-left"></i> Cancel</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Enregistrer</button>
        </div>

    </form>

@endsection
