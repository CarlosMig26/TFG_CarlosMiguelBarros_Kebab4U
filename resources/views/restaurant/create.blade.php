@extends('layout')

@section('title', 'Create Restaurant')

@section('bodyClass', 'class=create')

@section('content')

@if (session('success'))
<div class="popup" id="popup">
    <div class="popup-content">
        <span class="close" onclick="document.getElementById('popup').style.display='none'">&times;</span>
        <div class="alert success">
            <span class="close" onclick="this.parentElement.style.display='none'">&times;</span>
            {{__('¡Restaurante creado correctamente!')}}
        </div>
    </div>
</div>
@endif

<div class="restHeader" style="background-image: url('https://i.imgur.com/XgCZT0K.jpg')">
    <div class="txtTitle">
        <h1>{{__('Crear restaurante')}}</h1>
    </div>
</div>

<div class="restData">
    <form action="{{ route('restaurant.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="restInfo">
            <h2>{{__('Información del restaurante')}}</h2>
            <p>
                <label for="name">{{__('Nombre')}}:</label><br>
                <input type="text" id="name" name="name" required>
            </p>
            <p>
                <label for="email">{{__('Email')}}:</label><br>
                <input type="email" id="email" name="email" required>
            </p>
            <p>
                <label for="phone">{{__('Teléfono')}}:</label><br>
                <input type="tel" id="phone" name="phone" required>
            </p>
            <p>
                <label for="address">{{__('Dirección')}}:</label><br>
                <input type="text" id="address" name="address" required>
            </p>
            <p>
                <label for="image">{{__('Imagen')}}:</label><br>
                <input type="file" id="image" name="image" accept="image/*" required>
            </p>
        </div>

        <div class="restDetails">
            <h2>{{__('Detalles adicionales')}}</h2>
            <p>
                <label for="schedule">{{__('Horario')}}:</label><br>
                <input type="text" id="schedule" name="schedule" required>
            </p>
            <p>
                <label for="has_discount">{{__('Tiene descuento')}}:</label><br>
                <select id="has_discount" name="has_discount">
                    <option value="0">{{__('No')}}</option>
                    <option value="1">{{__('Si')}}</option>
                </select>
            </p>
            <p>
                <label for="tags">{{__('Tags')}}:</label><br>
                <input type="text" id="tags" name="tags" required>
            </p>
            <p>
                <label for="description">{{__('Descripción')}}:</label><br>
                <textarea id="description" name="description" rows="4" required></textarea>
            </p>
        </div>

        <div class="restSubmit">
            <button type="submit" class="comments-button">{{__('Crear restaurante')}}</button>
        </div>
    </form>
</div>
@endsection
