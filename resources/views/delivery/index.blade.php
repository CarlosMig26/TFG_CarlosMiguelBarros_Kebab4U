@extends('layout')

@section('title', 'Repartir')

@section('bodyClass', 'class=delivery')

@section('content')

    <div class="container">
        <div class="main-content">
            <div class="map-section">
                <div id="map"></div>
            </div>
            <div class="info-section">
                <h2>{{ __('Calculadora de Rutas') }}</h2>
                <div class="input-group">
                    <label for="start" class="form-label">{{ __('Inicio') }}:</label>
                    <input type="text" id="start" name="start" class="form-control">
                </div>
                <div class="input-group">
                    <label for="end" class="form-label">{{ __('Fin') }}:</label>
                    <input type="text" id="end" name="end" class="form-control">
                </div>
                <button onclick="calculateAndDisplayRoute()" class="calculate-route-btn">{{ __('Calcular Ruta') }}</button>
                <div id="routeInfo">
                    <p id="distance"></p>
                    <p id="time"></p>
                    <p id="earnings"></p>
                </div>
            </div>
            <div class="orders-section">
                <h2>{{ __('Pedidos') }}</h2>
                @if ($orders->isEmpty())
                    <p>{{ __('No hay pedidos por ahora.') }}</p>
                @else
                    <div class="order-list">
                        @foreach ($orders as $order)
                            @if ($order['status'] == 'cancelled')
                            <p>{{ __('Pedido cancelado') }}</p>
                            <hr>
                                @continue
                            @else
                                <div class="order-container {{ $order['status'] }}">
                                    <span class="delete-order-btn" data-order-id="{{ $order['id'] }}">&times;</span>
                                    @if ($order['user'])
                                        <p><strong>{{ __('Nombre del usuario') }}:</strong> {{ $order['user']->name }}</p>
                                        <p><strong>{{ __('Email del usuario') }}:</strong> {{ $order['user']->email }}</p>
                                        <p><strong>{{ __('Dirección del usuario') }}:</strong> <span
                                                class="usrAdd">{{ $order['user']->address }}</span></p>
                                    @else
                                        <p><strong>{{ __('Nombre del usuario') }}:</strong>
                                            {{ $order['guest_name'] ?? 'N/A' }}</p>
                                        <p><strong>{{ __('Email del usuario') }}:</strong>
                                            {{ $order['guest_email'] ?? 'N/A' }}</p>
                                        <p><strong>{{ __('Dirección del usuario') }}:</strong> <span
                                                class="gstAdd">{{ $order['guest_address'] ?? 'N/A' }}</span></p>
                                    @endif

                                    <h3>{{ __('Platos Ordenados') }}</h3>
                                    @foreach ($order['dishes'] as $dish)
                                        <p><strong>{{ __('ID del Plato') }}:</strong> {{ $dish['id'] }}</p>
                                        <p><strong>{{ __('Nombre del Plato') }}:</strong> {{ $dish['name'] }}</p>
                                        <p><strong>{{ __('Precio') }}:</strong> {{ $dish['price'] }}</p>
                                        <p><strong>{{ __('Cantidad') }}:</strong> {{ $dish['quantity'] }}</p>
                                        <p><strong>{{ __('Dirección del Restaurante') }}:</strong> <span
                                                class="resAdd">{{ $dish['restaurant_address'] }}</span></p>
                                    @endforeach
                                    <button class="set-route-btn acceptDeliveryBtn"
                                        data-order-id="{{ $order['id'] }}">{{ __('Aceptar Pedido') }}</button>
                                    <button class="set-route-btn completeDeliveryBtn" data-order-id="{{ $order['id'] }}"
                                        style="display:none;">{{ __('Marcar como Entregado') }}</button>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkf-OJzYn5cOg5HMvacFF77gVTLU7FKq4&libraries=places&callback=initMap"
        async defer></script>
    <script type="text/javascript" src="{{ asset('js/mapDelivery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/delivery.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
