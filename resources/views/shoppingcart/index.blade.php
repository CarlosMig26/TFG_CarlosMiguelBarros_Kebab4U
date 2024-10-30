@extends('layout')

@section('title', 'Carrito')

@section('bodyClass', 'class=shop-cart')

@section('content')

    <script src="{{ asset('js/general.js') }}" defer></script>

    <div id="alerts">
        @if (session('status'))
            <div class="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session()->has('success_msg'))
            <div class="alert success">
                {{ session()->get('success_msg') }}
            </div>
        @endif
        @if (session()->has('alert_msg'))
            <div class="alert warning">
                {{ session()->get('alert_msg') }}
                <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class="alert danger">
                    {{ $error }}
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
        @endif
    </div>
    <div class="container">
        <div class="row" id="carrito">
            <div class="col">
                <section class="section-text">
                    <div class="table-responsive">
                        <table class="product-table">
                            <thead class="table-header">
                                <tr>
                                    <th>{{ __('Platos') }}</th>
                                    <th>{{ __('Restaurant') }}</th>
                                    <th>{{ __('Precio') }}</th>
                                    <th>{{ __('Cantidad') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($total_dishes_count > 0)
                                    <h4>{{ $total_dishes_count }} {{ __('Plato(s) en el carrito') }}</h4><br>
                                @else
                                    <div class="text-center">
                                        <h4>{{ __('No hay Plato(s) en tu Carrito') }}</h4><br>
                                    </div>
                                    <tr>
                                        <td colspan="5" class="cntr">
                                            <a href="{{ route('principal') }}"
                                                class="btn-dark">{{ __('Ir a la tienda') }}</a>
                                        </td>
                                    </tr>
                                @endif

                                @foreach ($cart_dishes as $item)
                                    <tr>
                                        <td>
                                            {{ $item['name'] }}
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('restaurant.show', $item['restaurant_id']) }}">@php
                                                    $restaurant = App\Models\Restaurant::find($item['restaurant_id']);
                                                    echo $restaurant->name;
                                                @endphp</a>
                                        </td>
                                        <td class="product-price">
                                            ${{ number_format($item['price'] -  ($item['price'] * $item['discount']) / 100, 2) }}
                                        </td>
                                        <td>
                                            <form action="{{ route('cart.update') }}" method="POST" class="form-inline">
                                                @csrf
                                                <div class="input-group">
                                                    <input type="hidden" value="{{ $item['id'] }}" id="id"
                                                        name="id">
                                                    <input type="number" value="{{ $item['quantity'] }}" id="quantity"
                                                        name="quantity">
                                                        @error('quantity')
                                                            <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    <button class="btn-edit"><i class="fa fa-edit"></i></button>
                                            </form>
                                            <form action="{{ route('cart.remove') }}" method="POST" class="form-inline">
                                                @csrf
                                                <input type="hidden" value="{{ $item['id'] }}" id="id"
                                                    name="id">
                                                <button class="btn-delete"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                    </div>
                    </tbody>
                    </table>
                    <div id="checkoutModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            @guest
                                <h2>{{ __('Checkout como invitado') }}</h2>
                                <p>{{ __('Completa el formulario para realizar tu pedido como invitado') }}:</p>
                            @endguest
                            <form action="{{ route('cart.checkout') }}" method="POST">
                                @csrf
                                @guest
                                    <label for="name">{{ __('Nombre') }}:</label>
                                    <input type="text" id="name" name="name" required>
                                    @error('name')
                                        <div class="error">{{ $message }}</div>
                                    @enderror

                                    <label for="email">{{ __('Email') }}:</label>
                                    <input type="email" id="email" name="email" required>
                                    @error('email')
                                        <div class="error">{{ $message }}</div>
                                    @enderror

                                    <label for="phone">{{ __('Teléfono') }}:</label>
                                    <input type="text" id="phone" name="phone" required>
                                    @error('phone')
                                        <div class="error">{{ $message }}</div>
                                    @enderror

                                    <label for="address">{{ __('Dirección') }}:</label>
                                    <input type="text" id="address" name="address" required>
                                    @error('address')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                @endguest

                                <h3>{{ __('Detalles de Pago') }}</h3>

                                <label for="card_number">{{ __('Número de Tarjeta') }}:</label>
                                <input type="text" id="card_number" name="card_number" >
                                @error('card_number')
                                    <div class="error">{{ $message }}</div>
                                @enderror

                                <label for="expiry_date">{{ __('Fecha de Vencimiento') }}:</label>
                                <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" >
                                @error('expiry_date')
                                    <div class="error">{{ $message }}</div>
                                @enderror

                                <label for="cvv">{{ __('CVV') }}:</label>
                                <input type="text" id="cvv" name="cvv" >
                                @error('cvv')
                                    <div class="error">{{ $message }}</div>
                                @enderror

                                <button type="submit" class="btn btn-primary">{{ __('Realizar Pedido') }}</button>
                            </form>
                        </div>
                    </div>
                    <div class="checkout">
                        <h2 class="total-price">{{ __('Total') }}: {{ number_format($cart_total, 2) }}€</h2>
                        <div class="btns">
                            <a id="checkoutButton" class="btn-done">{{ __('Proceder al CheckOut') }}</a>
                            {{-- <a href="{{ route('cart.checkout') }}" class="btn-done">{{__('Proceder al CheckOut')}}</a> --}}
                            <a href="{{ route('principal') }}" class="btn-back">{{ __('Seguir comprando') }}</a>
                        </div>
                    </div>
            </div>
            </section>
        </div>
    </div>
    </div>
    <script>
        var modal = document.getElementById('checkoutModal');

        var checkoutButton = document.getElementById("checkoutButton");

        var span = document.getElementsByClassName("close")[0];

        checkoutButton.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

@endsection
