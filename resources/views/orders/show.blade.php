@extends('layout')

@section('title', 'Order Details')

@section('bodyClass', 'class=shop-cart')

@section('content')
<script src="{{ asset('js/order.js') }}" defer></script>
    <div class="receipt-container">
        <div class="receipt-title">{{__('Recibo de la compra')}}</div>
        <div class="receipt-id">{{__('ID del pedido')}}: {{ $order->id }}</div>
        <div class="receipt-status">{{__('Estado')}}: {{ $order->status }}</div>
        <div class="receipt-date">{{__('Fecha')}}: {{ $order->created_at->format('d-m-Y') }}</div>
        <div class="receipt-content">
            <div class="receipt-header">
                <div class="header-item">{{__('Plato')}}</div>
                <div class="header-quantity">{{__('Cantidad')}}</div>
                <div class="header-price">{{__('Precio')}}</div>
            </div>
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
            @endphp
            @foreach ($dishes as $item)
                @php
                    $itemTotal = $item['price'] * $item['quantity'];
                    $total += $itemTotal;
                @endphp
                <div class="receipt-item">
                    <div class="item-name">{{ $item['name'] }}</div>
                    <div class="item-quantity">{{ $item['quantity'] }}</div>
                    <div class="item-price">{{__('€')}}{{ number_format($itemTotal, 2) }}</div>
                </div>
            @endforeach
            <div class="receipt-total">
                <div>Total</div>
                <div>{{__('€')}}{{ number_format($total, 2) }}</div>
            </div>
        </div>
        <div class="receipt-thankyou">{{__('¡Gracias por la compra!')}}</div>
    </div>
    @if ($order->status === 'pending')
        <div class="receipt-actions">
            <form action="{{ route('order.destroy', $order->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">{{__('Cancelar pedido')}}</button>
            </form>
        </div>
    @elseif ($order->status === 'delivered' && !$alreadyRated)
        <div class="order-opinions">
            <h2>{{__('¿Te ha gustado?')}}</h2>
            <form action="{{ route('order.rate', $order->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="rating">{{__('Calificación')}}</label>
                    <div id="star-rating" class="star-rating">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa fa-star" data-value="{{ $i }}"></i>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="rating" value="0">
                </div>
                <button type="submit" class="btn btn-primary">{{__('Calificar Pedido')}}</button>
            </form>
        </div>
    @endif
    <div class="goBack">
        <a href="{{ route('principal') }}" class="btn btn-dark">{{__('Volver')}}</a>
    </div>
@endsection
