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

    <form action="{{ route('profile.submit') }}" method="post">
        @csrf

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

        <div>
            <a href="{{ route('login') }}" class="btn btn-outline-secondary"><i class="fa fa-angle-left"></i> Cancel</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Enregistrer</button>
        </div>

    </form>

@endsection
