@extends('layout')

@section('title', 'Perfil de Usuario')

@section('bodyClass', 'class=user')

@section('content')

    <h1 class="usrTitle">{{__('Mira, eres tú :^)')}}</h1>

    <div class="usrCard">
        @auth
            @if (Auth::user()->avatar)
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="avatar">
            @else
                <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatar">
            @endif
        @endauth
        <div class="usrInfo">
            <div class="usrName">
                <h2><span>{{__('Nombre')}}:</span> {{ Auth::user()->fullName }}</h2>
            </div>
            <hr>
            <div class="usrContact">
                <h4><span>{{__('Email')}}:</span> {{ Auth::user()->email }}</h4>
                <h4><span>{{__('Teléfono')}}:</span> {{ Auth::user()->phone }}</h4>
                <h4><span>{{__('Dirección')}}:</span> {{ Auth::user()->address }}</h4>
                <h4><span>{{__('Cumpleaños')}}:</span> {{ Auth::user()->birthday }}</h4>
            </div>
        </div>
    </div>
    <div class="usrAction">
        <div><a class="btn edit" href="{{ route('user.edit', Auth::user()) }}">{{__('Editar datos')}}</a></div>
        <form action="{{ route('user.destroy', Auth::user()) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn delete"
                onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">{{__('Eliminar')}}</button>
        </form>
    </div>

@endsection
