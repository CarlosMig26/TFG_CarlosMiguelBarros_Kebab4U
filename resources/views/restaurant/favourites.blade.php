@extends('layout')

@section('title', 'Mis Favoritos')

@section('content')

    <script src="{{ asset('js/itemSelect.js') }}" defer></script>

    <div class="resultsMsg">
        <h1>{{ __('Mis Restaurantes Favoritos') }}</h1>
        <h3>{{ __('¡Aquí están tus favoritos!') }}</h3>
    </div>

    @if ($favouriteRestaurants->isEmpty())
        <div class="noRestaurants">
            <h3>{{ __('No se encontraron restaurantes favoritos.') }}</h3>
            <button class="btn"><a href="{{ route('principal') }}">{{ __('Volver') }}</a></button>
        </div>
    @else
        <div class="itemRow">
            @foreach ($favouriteRestaurants as $restaurant)
                <div class="item" data-url="{{ route('restaurant.show', $restaurant->id) }}">
                    <div class="itemImg">
                        <img src="{{ asset('images/item.jpg') }}" alt="Item Image">
                    </div>
                    <div class="itemTxt">
                        <h2>{{ $restaurant->name }}</h2>
                        <p>{{ $restaurant->description }}</p>
                        <form action="{{ route('restaurant.unfavourite', $restaurant->id) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">{{ __('Eliminar de Favoritos') }}</button>
                        </form>
                        <a href="{{ route('restaurant.show', $restaurant->id) }}"><i class="fa-solid fa-door-open"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection
