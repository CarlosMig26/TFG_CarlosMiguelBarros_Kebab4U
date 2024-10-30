@extends('layout')

@section('title', 'Mis Pedidos')

@section('bodyClass', 'class=shop-cart')

@section('content')
    <div class="container">
        <h2>{{__('Mis pedidos')}}</h2>

        @if (count($orders) === 0)
            <h3 class="no-orders">{{__('No tienes pedidos todavia')}}:/</h3>
            <div class="goBack">
                <a href="{{ route('principal') }}">{{__('Volver')}}</a>
            </div>
        @else
            <div class="orders-container">
                @foreach ($orders as $order)
                    <div class="order-container">
                        <h4>{{__('ID del pedido')}}: {{ $order->id }}</h4>
                        <p>{{__('Estado')}}: {{ ucfirst($order->status) }}</p>
                        <p>{{__('Fecha')}}: {{ $order->created_at->format('d-m-Y') }}</p>

                        @php
                            $total = 0;
                            $orderData = json_decode($order->order_data, true);
                            $dishes = array_filter(
                                $orderData,
                                function ($key) {
                                    return is_numeric($key);
                                },
                                ARRAY_FILTER_USE_KEY,
                            );

                            foreach ($dishes as $dish) {
                                $discounted_price = $dish['price'] * (1 - $dish['discount'] / 100);
                                $subtotal = $dish['quantity'] * $discounted_price;
                                $total += $subtotal;
                            }
                        @endphp

                        <p>{{__('Total')}}: {{__('$')}}{{ number_format($total, 2) }}</p>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-dark">{{__('Ver detalles')}}</a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
