@extends('layout')

@section('title', 'Perfil de Repartidor')

@section('bodyClass', 'class=user')

@section('content')

    <h1 class="usrTitle">{{__('Mira, eres tú :^)')}}</h1>

    <div class="usrCard">
        @auth
            @if (session('avatar') == null)
                <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatar">
            @else
                <img src="{{ session('avatar') }}" alt="Avatar" class="avatar">
            @endif
        @endauth
        <div class="usrInfo">
            <div class="usrName">
                <h2><span>{{__('Nombre')}}:</span> {{ Auth::user()->fullName }}</h2>
            </div>
            <hr>
            <div class="usrContact">
                <h4><span>{{__('Email')}}:</span> {{ Auth::user()->email }}</h4>
                <h4><span>{{__('Telefono')}}:</span> {{ Auth::user()->phone }}</h4>
                <h4><span>{{__('Dirección')}}:</span> {{ Auth::user()->address }}</h4>
                <h4><span>{{__('Cumpleaños')}}:</span> {{ Auth::user()->birthday }}</h4>
            </div>
        </div>
    </div>

@endsection
