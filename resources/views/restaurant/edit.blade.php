@extends('layout')

@section('title', 'Editar restaurante')

@section('bodyClass', 'class=restaurant')

@section('content')
    <script src="{{ asset('js/restaurant.js') }}" async defer></script>

    <form action="{{ route('restaurant.update', $restaurant) }}" method="post" class="form-container"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @if ($restaurant->image)
            <div class="restHeader" style="background-image: url('{{ asset('storage/' . $restaurant->image) }}');">
            @else
                <div class="restHeader" style="background-image: url('{{ asset('images/platter.jpg') }}');">
        @endif
        <div class="txtTitle">
            <input type="text" name="name" id="name" value="{{ $restaurant->name }}">
            <label for="name"><i class="fa-solid fa-pen"></i></label>
        </div>
        </div>
        <div class="restData">
            <div class="restDescription">
                <label for="description">{{ __('Descripción') }} <i class="fa-solid fa-pen"></i></label><br>
                <textarea name="description" id="description">{{ $restaurant->description }}</textarea><br>
                <label for="tags">{{ __('Etiquetas') }} <i class="fa-solid fa-pen"></i></label><br>
                <input type="text" name="tags" id="tags" value="{{ $restaurant->tags }}">
            </div>
            <div class="restInfo">
                <div class="restAddress">
                    <label for="address">{{ __('Dirección') }} <i class="fa-solid fa-pen"></i></label><br>
                    <input type="text" name="address" id="address" value="{{ $restaurant->address }}">
                </div>
                <div class="restPhone">
                    <label for="phone">{{ __('Teléfono') }} <i class="fa-solid fa-pen"></i></label><br>
                    <input type="text" name="phone" id="phone" value="{{ $restaurant->phone }}">
                </div>
                <div class="restEmail">
                    <label for="email">{{ __('Correo electrónico') }} <i class="fa-solid fa-pen"></i></label><br>
                    <input type="text" name="email" id="email" value="{{ $restaurant->email }}">
                </div>
            </div>
            <div class="restOpinion">
                <div class="restComments">
                    <label for="schedule">{{ __('Horario') }} <i class="fa-solid fa-pen"></i></label><br>
                    <input type="text" name="schedule" id="schedule" value="{{ $restaurant->schedule }}">
                </div>
                <div class="restRanking">
                    <label for="has_discount">{{ __('Tiene descuentos') }} <i class="fa-solid fa-pen"></i></label><br>
                    <input type="checkbox" name="has_discount" id="has_discount"
                        {{ $restaurant->has_discount ? 'checked' : '' }}>
                </div>
                <div class="restImage">
                    <label for="image">{{ __('Imagen') }} <i class="fa-solid fa-pen"></i></label><br>
                    <input type="file" name="image" id="image">
                </div>
                @if ($restaurant->image)
                    <img class="miniExample" src="{{ asset('storage/' . $restaurant->image) }}"
                        alt="{{ $restaurant->name }}">
                @else
                    <p>No hay imagen disponible</p>
                @endif  
            </div>
        </div>
        <div class="confirm-btn">
            <button type="submit">{{ __('Guardar Cambios') }}</button>
        </div>
    </form>
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
                                <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}">
                            @else
                                <img src="{{ asset('images/dishes/kebab' . rand(1, 7) . '.jpg') }}"
                                    alt="{{ $dish->name }}">
                            @endif
                            <div class="dish-info">
                                <h2>{{ $dish->name }}</h2>
                                <p>{{ $dish->description }}</p>
                                <p><strong>{{ __('Ingredientes:') }}</strong> {{ $dish->ingredients }}</p>
                                <p><strong>{{ __('Precio:') }}</strong> ${{ $dish->price }}</p>
                            </div>
                            <div class="button">
                                <button onclick="toggleEditForm({{ $dish->id }})">{{ __('Editar') }}</button>
                            </div>
                            <div id="edit-form-{{ $dish->id }}" class="dish-edit-form" style="display: none;">
                                <h2>{{ __('Editar Plato') }}</h2>
                                <form action="{{ route('dishes.update', $dish->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label for="d-name">{{ __('Nombre') }}</label>
                                        <input type="text" name="d-name" id="d-name"
                                            value="{{ old('d-name', $dish->name) }}">
                                        @error('d-name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="d-description">{{ __('Descripción') }}</label>
                                        <textarea name="d-description">{{ old('d-description', $dish->description) }}</textarea>
                                        @error('d-description')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="d-ingredients">{{ __('Ingredientes') }}</label>
                                        <textarea name="d-ingredients" id="d-ingredients">{{ old('d-ingredients', $dish->ingredients) }}</textarea>
                                        @error('d-ingredients')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="d-price">{{ __('Precio') }}</label>
                                        <input type="number" name="d-price" id="d-price" step="0.01"
                                            value="{{ old('d-price', $dish->price) }}">
                                        @error('d-price')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="d-discount">{{ __('Descuento') }}</label>
                                        <input type="number" name="d-discount" id="d-discount" step="0.01"
                                            value="{{ old('d-discount', $dish->discount) }}">
                                        @error('d-discount')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="d-image">{{ __('Imagen') }}</label>
                                        <input type="file" name="d-image" id="d-image">
                                        @error('d-image')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit">{{ __('Guardar cambios') }}</button>
                                </form>
                            </div>
                            <div>
                                <form action="{{ route('dishes.destroy', $dish->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dlt-btn">{{ __('Eliminar') }}</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <h2>{{ __('Agregar Nuevo Plato') }}</h2>
            <form action="{{ route('dishes.store') }}" method="POST" enctype="multipart/form-data"
                class="add-dish-form">
                @csrf
                <div>
                    <label for="n-name">{{ __('Nombre') }}</label>
                    <input type="text" name="n-name" id="n-name" value="{{ old('n-name') }}">
                    @error('n-name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="n-description">{{ __('Descripción') }}</label>
                    <textarea name="n-description" id="n-description">{{ old('n-description') }}</textarea>
                    @error('n-description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="n-ingredients">{{ __('Ingredientes') }}</label>
                    <textarea name="n-ingredients" id="n-ingredients">{{ old('n-ingredients') }}</textarea>
                    @error('n-ingredients')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="n-price">{{ __('Precio') }}</label>
                    <input type="number" name="n-price" id="n-price" step="0.01" value="{{ old('n-price') }}">
                    @error('n-price')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="n-discount">{{ __('Descuento') }}</label>
                    <input type="number" name="n-discount" id="n-discount" step="0.01"
                        value="{{ old('n-discount') }}">
                    @error('n-discount')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="n-image">{{ __('Imagen') }}</label>
                    <input type="file" name="n-image" id="n-image">
                    @error('n-image')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit">{{ __('Agregar Plato') }}</button>
            </form>
        </div>
    </div>
@endsection
