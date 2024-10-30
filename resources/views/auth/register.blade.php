@extends('layout')

@section('bodyClass', 'class=auth')

@section('title', 'Registrarse')

@section('content')

    <script type="text/javascript" src="{{ asset('js/form.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/verifyEmail.js') }}" defer></script>

    <div class="registration_type" id="registrationButtons">
        <div class="chooseImg user">
            <img src="{{ asset('images/user.png') }}" id="userRegistrationImg" alt="Registro de Usuario">
            <h1>{{__('Regístrate como Cliente')}}</h1>
        </div>
        <div class="chooseImg rest">
            <img src="{{ asset('images/rest.png') }}" id="restaurantRegistrationImg" alt="Registro de Restaurante">
            <h1>{{__('Regístrate como Restaurante')}}</h1>
        </div>
    </div>

    <section id="loading">
        <div id="loading-content"></div>
    </section>

    <div id="userRegistrationForm" style="display: none;">
        <div class="form_wrapper">
            <div class="form_container">
                <div class="title_container">
                    <h2>{{__('¡Registrate gratis aquí!')}}</h2>
                </div>
                <div class="row clearfix">
                    <div>
                        <form action="{{ route('usrSignup') }}" method="post">
                            @csrf
                            <div class="input_field">
                                <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                <input type="text" id="fullName" name="fullName" placeholder="{{__('Nombre completo')}}" value="{{ old("fullName")}}" />
                            </div>
                            @error('fullName')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <div class="input_field">
                                <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                                <input type="email" id="email" name="email" placeholder="{{__('Email')}}" value="{{ old("email")}}"/>
                            </div>
                            <p id="validEmail"></p>
                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <div class="input_field">
                                <span><i aria-hidden="true" class="fa fa-map-marked-alt"></i></span>
                                <input type="text" id="address" name="address" placeholder="{{__('Dirección')}}" value="{{ old("address")}}"/>
                            </div>
                            @error('address')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <div class="row clearfix">
                                <div class="col_half">
                                    <div class="input_field">
                                        <span><i aria-hidden="true" class="fa fa-calendar-alt"></i></span>
                                        <input type="date" id="birthDay" name="birthDay" />
                                    </div>
                                    @error('birthDay')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col_half">
                                    <div class="input_field">
                                        <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                                        <input type="text" id="phone" name="phone" placeholder="612345678" value="{{ old("phone")}}"/>
                                    </div>
                                    @error('phone')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="input_field">
                                <span><i aria-hidden="true" class="fa fa-camera"></i></span>
                                <input type="file" id="avatar" name="avatar" />
                            </div>
                            @error('avatar')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <div class="input_field">
                                <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                                <input type="password" id="password" name="password" placeholder="{{__('Contraseña')}}" />
                            </div>
                            @error('password')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <div class="input_field checkbox_option">
                                <input type="checkbox" id="cb1" required>
                                <label for="cb1">{{__('Estoy de acuerdo con')}}<a href="{{ route('principal') }}">{{__(' los terminos y condiciones')}}</a></label>
                            </div>
                            <div class="input_field checkbox_option">
                                <input type="checkbox" id="cb2">
                                <label for="cb2">{{__('Quiero recibir información sobre la empresa')}}</label>
                            </div>
                            <input class="button" type="submit" value="Register" />
                        </form>
                    </div>
                </div>
            </div>
            <button id="backBtn"><i class="fa-solid fa-arrow-left"></i></button>
        </div>
    </div>

    <div id="restaurantRegistrationForm" style="display: none;">
        <div class="form_wrapper">
            <div class="form_container">
                <div class="title_container">
                    <h2>{{__('¡Registrate gratis aquí!')}}</h2>
                </div>
                <div class="row clearfix">
                    <div class="">
                        <form action="{{ route('restSignup') }}" method="POST">
                            @csrf
                            <div class="input_field">
                                <span><i aria-hidden="true" class="fa fa-utensils"></i></span>
                                <input type="text" id="resName" name="resName" placeholder="{{__('Nombre del restaurante')}}" />
                            </div>
                            @error('resName')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <div class="input_field">
                                <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                                <input type="email" id="resEmail" name="resEmail" placeholder="{{__('Email')}}" />
                            </div>
                            @error('resEmail')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <div class="input_field">
                                <span><i aria-hidden="true" class="fa fa-map-marker-alt"></i></span>
                                <input type="text" id="resAddress" name="resAddress" placeholder="{{__('Dirección')}}" />
                            </div>
                            @error('resAddress')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <div class="input_field">
                                <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                                <input type="text" id="resPhone" name="resPhone" placeholder="{{__('Teléfono')}}" />
                            </div>
                            @error('resPhone')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <div class="input_field">
                                <span><i aria-hidden="true" class="fa-solid fa-calendar-plus"></i></span>
                                <input type="date" id="inaugurationDate" name="inaugurationDate" />
                            </div>
                            @error('inaugurationDate')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <div class="input_field">
                                <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                                <input type="password" id="resPassword" name="resPassword" placeholder="{{__('Contraseña')}}" />
                            </div>
                            @error('resPassword')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <input class="button" type="submit" value="Register" />
                        </form>
                    </div>
                </div>
            </div>
            <button id="backBtn"><i class="fa-solid fa-arrow-left"></i></button>
        </div>
    </div>

@endsection
