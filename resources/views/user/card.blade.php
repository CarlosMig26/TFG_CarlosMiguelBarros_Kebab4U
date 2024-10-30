@extends('layout')

@section('title', 'Carta de Puntos')

@section('bodyClass', 'class=user')

@section('content')
<div class="card-container">
    <h1>{{__('Tus puntos')}}</h1>
    <div class="order-counts">
        @foreach ($orderCounts as $restaurantId => $count)
            <div class="restaurant-card">
                <h2>{{__('Restaurante ID')}}: {{ $restaurantId }}</h2>
                <p>{{__('Número de pedidos')}}: {{ $count }}</p>
                @if ($count >= 6)
                    <p class="discount">{{__('¡Felicidades! Tienes un 50% de descuento en tu próximo pedido en este restaurante.')}}</p>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
