@extends('layout')

@section('title', 'Error: 404 Not Found')

@section('content')

    <div class="errorContainer">
        <div class="errorMsg">
            <h1>404</h1>
            <h2>Not Found</h2>
        </div>
        <img src="{{ asset('images/404.png') }}" alt="404 Not Found">
        <p>{{__('Lo siento, parece que la pagina que buscas no existe :(')}}</p>

        <a href="{{ route('principal') }}" class="btn">{{__('Volver')}}</a>
    </div>

@endsection
