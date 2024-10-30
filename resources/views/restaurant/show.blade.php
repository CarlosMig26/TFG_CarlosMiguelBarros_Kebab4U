@extends('layout')

@section('title', 'Restaurant')

@section('bodyClass', 'class=restaurant')

@section('content')
    <div id="popup" class="popup">
        <div class="popup-content">
            <div id="alerts">
                @if (session()->has('success_msg'))
                    <div class="alert success">
                        {{ session()->get('success_msg') }}
                    </div>
                @endif
                @if (session()->has('alert_msg'))
                    <div class="alert warning">
                        {{ session()->get('alert_msg') }}
                        <button type="button" class="close" aria-label="Close" onclick="closePopup()">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="alert danger">
                            {{ $error }}
                            <button type="button" class="close" aria-label="Close" onclick="closePopup()">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    @if ($restaurant->image)
        <div class="restHeader" style="background-image: url('{{ asset('storage/' . $restaurant->image) }}');">
        @else
            <div class="restHeader" style="background-image: url('{{ asset('images/platter.jpg') }}');">
    @endif
    <div class="txtTitle">
        <h1 class="restTitle">{{ $restaurant->name }}</h1>
    </div>
    <div class="icons">
        @if (Auth::check() && (Auth::user()->role === 'client' || Auth::user()->role === 'admin'))
            @php
                $favourites = Auth::user()->favourites ?? [];
            @endphp
            @if (in_array($restaurant->id, $favourites))
                <form action="{{ route('restaurant.unfavourite', $restaurant->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="unfav-icon espIco">
                        <i class="fa-solid fa-heart"></i>
                    </button>
                </form>
            @else
                <form action="{{ route('restaurant.favourite', $restaurant->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="fav-icon espIco">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </form>
            @endif

        @endif
        @if (Auth::check() &&
                ((Auth::user()->role === 'restaurant' && Auth::user()->restaurant_id === $restaurant->id) ||
                    Auth::user()->role === 'admin'))
            <a href="{{ route('restaurant.edit', ['restaurant' => $restaurant->id]) }}" class="edit-icon espIco"><i
                    class="fa-solid fa-pen-to-square"></i></a>
            <form action="{{ route('restaurant.destroy', ['restaurant' => $restaurant->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-icon espIco"
                    onclick="return confirm('{{ __('¿Estás seguro de que deseas eliminar este restaurante?') }}');">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            </form>
        @endif
    </div>
    </div>
    <div class="restData">
        <div class="restDescription">
            <h2>{{ __('Descripción') }}</h2>
            <p>{{ $restaurant->description }}</p>
            <h2>{{ __('Tags') }}</h2>
            <p>{{ $restaurant->tags }}</p>
        </div>
        <div class="restInfo">
            <div class="restAddress">
                <h2>{{ __('Dirección') }}</h2>
                <p>{{ $restaurant->address }}</p>
            </div>
            <div class="restPhone">
                <h2>{{ __('Teléfono') }}</h2>
                <p>{{ $restaurant->phone }}</p>
            </div>
            <div class="restEmail">
                <h2>{{ __('Email') }}</h2>
                <p>{{ $restaurant->email }}</p>
            </div>
            <div class="restSchedule">
                <h2>{{ __('Horario') }}</h2>
                <p>{{ $restaurant->schedule }}</p>
            </div>
        </div>
        <div class="restOpinion">
            <div class="restRanking">
                <h2>{{ __('Valoración') }}</h2>
                <div class="stars">
                    @php
                        $averageRating = $restaurant->averageRating();
                        $fullStars = floor($averageRating);
                        $halfStar = $averageRating - $fullStars >= 0.5;
                    @endphp
                    @for ($i = 0; $i < $fullStars; $i++)
                        <i class="fa fa-star"></i>
                    @endfor
                    @if ($halfStar)
                        <i class="fa fa-star-half-alt"></i>
                    @endif
                    @for ($i = $fullStars + $halfStar; $i < 5; $i++)
                        <i class="fa fa-star-o"></i>
                    @endfor
                </div>
            </div>
            <div class="restComments">
                <h2>{{ __('Comentarios') }}</h2>
                <a href="{{ route('restaurant.comments', $restaurant->id) }}"
                    class="comments-button">{{ __('Ver Comentarios') }}</a>
            </div>
        </div>
    </div>

    <div class="restItems">
        <div class="restDishes">
            <h1>{{ __('Platos') }}</h1>
            <hr>
            <hr class="mini">
            <hr class="micro">
            @if ($restaurant->dishes->isEmpty())
                <p>{{ __('No hay platos disponibles para este restaurante.') }}</p>
            @else
                <div class="dishes-grid">
                    @foreach ($restaurant->dishes as $dish)
                        <div class="dish-item">
                            @if ($dish->image)
                                <img src="{{ asset('storage/' . $dish->image) }}"
                                    alt="{{ $dish->name }}">
                            @else
                                <img src="{{ asset('images/dishes/kebab' . rand(1, 7) . '.jpg') }}"
                                    alt="{{ $dish->name }}">
                            @endif
                            <div class="dish-info">
                                <h2 class="">{{ $dish->name }}</h2>
                                <h4>{{ $dish->description }}</h4>
                                <h4><strong>{{ __('Ingredientes') }}:</strong> {{ $dish->ingredients }}</h4>
                                @if ($dish->discount == 0.0)
                                    <h4><strong>{{ __('Precio') }}:</strong> ${{ $dish->price }}</h4>
                                @else
                                    <h4><strong>{{ __('Precio') }}:</strong><span
                                            class="oldPrice">${{ $dish->price }}</span><span
                                            class="discount">${{ number_format($dish->price - ($dish->price * $dish->discount) / 100, 2) }}</span>
                                    </h4>
                                @endif
                            </div>
                            @if (Auth::check() && Auth::user()->role === 'restaurant')
                                <button class="add-to-cart"><i class="fa-solid fa-cart-plus"></i>
                                    {{ __('Botón ejemplo') }}</button>
                            @else
                                <div class="button">
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $dish->id }}" id="id" name="id">
                                        <input type="hidden" value="{{ $dish->restaurant_id }}" id="resID"
                                            name="resID">
                                        <input type="hidden" value="{{ $dish->name }}" id="name" name="name">
                                        <input type="hidden" value="{{ $dish->price }}" id="price" name="price">
                                        <input type="hidden" value="{{ $dish->discount }}" id="discount" name="discount">
                                        <input type="hidden" value="{{ $dish->description }}" id="description"
                                            name="description">
                                        <input type="hidden" value="{{ $dish->image }}" id="image"
                                            name="image">
                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                        <div class="card-footer" style="background-color: white;"></div>
                                        <button class="add-to-cart" data-dish-id="{{ $dish->id }}"
                                            title="{{ __('Agregar al carrito') }}">
                                            <i class="fa-solid fa-cart-plus"></i> {{ __('Agregar al carrito') }}
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

@endsection
