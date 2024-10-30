@extends('layout')

@section('title', 'Login')

@section('bodyClass', 'class=auth')

@section('content')

    @php
        $input = ['caja', 'corazon', 'especial', 'explosion', 'fire', 'premio'];
        $randomWord = $input[array_rand($input)];
    @endphp

    <div class="loginForm">
        <div class="form_container">
            <div class="title_container">
                <h2>{{__('¡Cuanto tiempo sin verte :D!')}}</h2>
                <h3>{{__('Inicia sesión para ver nuevos restaurantes o pedir de los clásicos ;)')}}</h3>
            </div>
            <div class="row clearfix">
                <div class="form_content">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                            <input type="text" name="fullName" placeholder="{{__('Nombre o Email')}}" required />
                        </div>
                        @error('resPhone')
                                <div class="error">{{ $message }}</div>
                        @enderror
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                            <input type="password" name="password" placeholder="{{__('Contraseña')}}" required />
                        </div>
                        <div class="input_field checkbox_option">
                            <input type="checkbox" id="remember" name="remember" hidden>
                            <label for="remember">{{__('Recordarme')}}</label>
                        </div>
                        <input class="button" type="submit" value="Login" />
                    </form>
                </div>
                <div class="image_container">
                    <img src="{{ asset('images/rand/' . $randomWord . '.png') }}" alt="Imagén aleatoria">
                </div>
            </div>
        </div>
    </div>

@endsection
