@extends('layout')

@section('title', 'Recibo')

@section('bodyClass', 'class=shop-cart')

@section('content')
    <div class="container receipt-container">
        <h2 class="receipt-title">{{__('Recibo del pedido')}}</h2>
        @if (isset($user))
            <p class="receipt-thankyou">{{__('¡Gracias por tu pedido')}}, {{Auth::user()->fullName}}!</p>
        @else
            <p class="receipt-thankyou">{{__('¡Gracias por tu pedido')}}, {{__('Invitado')}}!</p>
        @endif
        <h4 class="receipt-id">{{__('ID del pedido')}}: {{ $order->id }}</h4>
        <h4 class="receipt-status">{{__('Estado')}}: {{ ucfirst($order->status) }}</h4>

        <div class="receipt-content">
            <div class="receipt-header">
                <span class="header-item">{{__('Plato')}}</span>
                <span class="header-quantity">{{__('Cantidad')}}</span>
                <span class="header-price">{{__('Precio')}}</span>
                <span class="header-subtotal">{{__('Subtotal')}}</span>
            </div>
            <div class="receipt-body">
                @php
                    $total = 0;
                    $order_data = json_decode($order->order_data, true);
                    if (is_array($order_data)) {
                        $dishes = array_filter(
                            $order_data,
                            function ($key) {
                                return is_numeric($key);
                            },
                            ARRAY_FILTER_USE_KEY,
                        );
                    } else {
                        $dishes = [];
                    }
                @endphp
                @foreach ($dishes as $dish)
                    @php
                        $discounted_price = $dish['price'] * (1 - $dish['discount'] / 100);
                        $subtotal = $dish['quantity'] * $discounted_price;
                        $total += $subtotal;
                    @endphp
                    <div class="receipt-item">
                        <span class="item-name">{{ $dish['name'] }}</span>
                        <span class="item-quantity">{{ $dish['quantity'] }}</span>
                        <span class="item-price">{{__('€')}}{{ number_format($discounted_price, 2) }}</span>
                        <span class="item-subtotal">{{__('€')}}{{ number_format($subtotal, 2) }}</span>
                    </div>
                @endforeach
                <div class="receipt-total">
                    <strong>{{__('Total')}}</strong>
                    <strong>{{__('€')}}{{ number_format($total, 2) }}</strong>
                </div>
            </div>
        </div>
        <div class="text-center">
            <a href="{{ route('principal') }}" class="btn btn-dark">{{__('Volver')}}</a>
        </div>
    </div>
@endsection
