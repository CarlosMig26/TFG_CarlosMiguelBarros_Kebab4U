@extends('layout')

@section('title', 'Resultados')

@section('content')

    <script src="{{ asset('js/itemSelect.js') }}" defer></script>
    @if (isset($filter) && isset($query))
        <div class="resultsMsg">
            <h1>{{ __('Resultados de la búsqueda por') }} {{ $filter }}</h1>
            <h3>{{ __('Resultados para') }}: "{{ $query }}"</h3>
        </div>
    @else
        <div class="resultsMsg">
            <h1>{{ __('Resultados de la búsqueda') }}</h1>
        </div>
    @endif

    @if ($restaurants->isEmpty())
        <div class="noRestaurants">
            <h3>{{ __('No se encontraron restaurantes.') }}</h3>
            <button class="btn"><a href="{{ route('principal') }}">{{ __('Volver') }}</a></button>
        </div>
    @else
        <div class="itemRow">
            @foreach ($restaurants as $restaurant)
                <div class="item" data-url="{{ route('restaurant.show', $restaurant->id) }}">
                    <div class="itemImg">
                        <img src="{{ asset('images/item.jpg') }}" alt="Item Image">
                    </div>
                    <div class="itemTxt">
                        <h2>{{ $restaurant->name }}</h2>
                        <p>{{ $restaurant->description }}</p>
                        <a href="{{ route('restaurant.show', $restaurant->id) }}"><i class="fa-solid fa-door-open"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection
