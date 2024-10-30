@extends('layout')

@section('title', 'Mapa')

@section('content')

@section('bodyClass', 'class=map')

<div class="map-container">
    <form>
        <label for="restaurant-select">
            <span>{{__('¿Qué restaurante buscas?')}}</span>
        </label>
        <select id="restaurant-select" class="map-input">
            <option value="">{{__('Selecciona un restaurante...')}}</option>
            @foreach ($restaurants as $restaurant)
                <option value="{{ $restaurant->address }}" data-url="{{ route('restaurant.show', $restaurant->id) }}">{{ $restaurant->name }}</option>
            @endforeach
        </select>
        <div id="address-map-container">
            <div id="address-map"></div>
        </div>
        <fieldset role="group">
            <label for="address-latitude" hidden>
                <span>Latitud</span>
                <input type="text" id="address-latitude" placeholder="Latitud"/>
            </label>
            <label for="address-longitude" hidden>
                <span>Longitud</span>
                <input type="text" id="address-longitude" placeholder="Longitud"/>
            </label>
        </fieldset>
        <input type="hidden" id="restaurant-url">
    </form>
</div>



<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkf-OJzYn5cOg5HMvacFF77gVTLU7FKq4&libraries=places&callback=initialize" async defer></script>
<script type="text/javascript" src="{{asset('js/mapMain.js')}}" async defer></script>

@endsection
