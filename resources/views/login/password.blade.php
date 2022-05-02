<?php
/** @var \App\Models\User $user */
?>

@extends('template')

@section('title')
    Modification du mot de passe
@endsection

@section('content')
    <h2>Modification du mot de passe</h2>

    <form action="{{ route('profile.password-submit') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="user-current_password">Mot de passe actuel *</label>
            <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" id="user-current_password"
                   value="{{ old('current_password') }}" required/>
            @error('current_password')
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
            <a href="{{ route('profile') }}" class="btn btn-outline-secondary"><i class="fa fa-angle-left"></i> Cancel</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Enregistrer</button>
        </div>

    </form>

@endsection
