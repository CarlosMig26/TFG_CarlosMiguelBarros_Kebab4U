@extends('layout')

@section('title', 'Descuentos')

@section('content')

    <script src="{{ asset('js/itemSelect.js') }}" defer></script>
    <div class="resultsMsg">
        <h1>{{__('Restaurantes con descuentos')}}</h1>
        <h3>{{__('¡Visita los restaurantes con precios de locos :O!')}}</h3>
    </div>

    @if ($restaurants->isEmpty())
        <div class="noRestaurants">
            <h3>{{__('No se encontraron restaurantes.')}}</h3>
            <button class="btn"><a href="{{ route('principal') }}">{{__('Volver')}}</a></button>
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
