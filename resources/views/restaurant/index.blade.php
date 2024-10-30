@extends('layout')

@section('title', 'Index')

@section('content')

    <script src="{{ asset('js/itemSelect.js') }}" defer></script>
    <script src="{{ asset('js/general.js') }}" defer></script>

    <div id="alerts">
        @if (session('status'))
            <div class="sessionAlert success">
                {{ session('status') }}
            </div>
        @endif
        @if (session()->has('success_msg'))
            <div class="sessionAlert success">
                {{ session()->get('success_msg') }}
            </div>
        @endif
        @if (session()->has('alert_msg'))
            <div class="sessionAlert warning">
                {{ session()->get('alert_msg') }}
                <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if (session()->has('errors'))
                <div class="sessionAlert danger">
                    {{  session()->get('errors')}}
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
        @endif
    </div>

    <div class="cardRow">
        <div class="card item" data-url="{{ route('restaurant.discount') }}">
            <div class="cardImg">
                <img src="{{ asset('images/platter.jpg') }}" alt="Card Image">
                <div class="overlay"></div>
                <div class="centered">{{__('Descuentos')}}</div>
            </div>
            <div class="cardTxt">
                <h2>{{__('Restaurantes con descuentos')}}</h2>
                <p>{{__('¡Visita los restaurantes con precios de locos :O!')}}</p>
                <a href="{{ route('restaurant.discount')}}"><i class="fa-solid fa-right-to-bracket"></i></a>
            </div>
        </div>

        @auth
            <div class="card item" data-url="{{ route('restaurant.favourites')}}">
                <div class="cardImg">
                    <img src="{{ asset('images/favourite.jpg') }}" alt="Card Image">
                    <div class="overlay"></div>
                <div class="centered">{{__('Favoritos')}}</div>
                </div>
                <div class="cardTxt">
                    <h2>{{__('Restaurantes favoritos')}}</h2>
                    <p>{{__('¡Visita tus restaurantes favoritos!')}}</p>
                    <a href="{{ route('restaurant.favourites')}}"><i class="fa-solid fa-right-to-bracket"></i></a>
                </div>
            </div>
        @endauth
    </div>
    <div class="itemRow">
        @foreach ($restaurants as $restaurant)
            <div class="item" data-url="{{ route('restaurant.show', $restaurant->id) }}">
                <div class="itemImg">
                    @if ($restaurant->image)
                        <img src="{{ asset('storage/' . $restaurant->image) }}" alt="Item Image">
                    @else
                        <img src="{{ asset('images/item.jpg') }}" alt="Item Image">
                    @endif
                </div>
                <div class="itemTxt">
                    <h2>{{ $restaurant->name }}</h2>
                    <p>{{ $restaurant->description }}</p>
                    <a href="{{ route('restaurant.show', $restaurant->id) }}"><i class="fa-solid fa-door-open"></i></a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
