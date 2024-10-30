@extends('layout')

@section('title', 'Editar Usuario')

@section('bodyClass', 'class=user')

@section('content')

<div class="usrForm">
    <h1>{{__('Edita tu información personal')}}</h1>
    <form method="POST" action="{{ route('user.update', Auth::user()) }}" class="form-container" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="fullName">{{__('Nombre')}}:</label>
            <input type="text" id="fullName" name="fullName" value="{{ old('fullName', $user->fullName) }}">
            @error('fullName')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">{{__('Email')}}:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}">
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">{{__('Teléfono')}}:</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
            @error('phone')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="address">{{__('Dirección')}}:</label>
            <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}">
            @error('address')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="birthday">{{__('Cumpleaños')}}:</label>
            <input type="date" id="birthday" name="birthday" value="{{ old('birthday', $user->birthday) }}">
            @error('birthday')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="avatar">{{__('Avatar')}}:</label>
            <input type="file" id="avatar" name="avatar">
            @error('avatar')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="current_password">{{__('Contraseña Actual')}}:</label>
            <input type="password" id="current_password" name="current_password">
            @error('current_password')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">{{__('Nueva Contraseña')}}:</label>
            <input type="password" id="password" name="password">
            @error('password')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{__('Confirmar Contraseña')}}:</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>
        <div class="form-group-btn">
            <button type="submit" class="btn">{{__('Actualizar')}}</button>
        </div>
    </form>

    <div class="move"><a class="backBtn btn" href="{{ route('user.index') }}">{{__('Volver')}}</a></div>
</div>

@endsection
