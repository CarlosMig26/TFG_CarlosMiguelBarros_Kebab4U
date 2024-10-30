<header class="head">
    <div class="header-top">
        <div class="main-icon">
            <a href="{{ route('principal') }}" class="logo"><img src="{{ asset('images/logo.png') }}" class="logo"></a>
        </div>
        <div class="search-box">
            <form action="{{ route('restaurant.results') }}" method="GET">
                <select name="filter" class="search-filter">
                    <option value="name">{{ __('Nombre') }}</option>
                    <option value="tags">{{ __('Tags') }}</option>
                    <option value="address">{{ __('Dirección') }}</option>
                </select>
                <input type="text" name="query" class="search-txt" placeholder="Buscar">
                <button type="submit" class="search-btn link">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <div class="language-switcher">
            <div class="dropdown">
                @php
                    switch (Session::get('locale')) {
                        case 'es':
                            echo '<span>Idiomas<i class="fa-solid fa-caret-down"></i></span>';
                            break;
                        case 'en':
                            echo '<span>Languages<i class="fa-solid fa-caret-down"></i></span>';
                            break;
                        case 'ca':
                            echo '<span>Idiomes<i class="fa-solid fa-caret-down"></i></span>';
                            break;
                    }
                @endphp
                <div class="dropdown-content">
                    @php
                        switch (Session::get('locale')) {
                            case 'es':
                                echo '<a href="' .
                                    route('change.language', ['lang' => 'en']) .
                                    '"><img src="' .
                                    asset('images/uk-flag.svg') .
                                    '" alt="Inglés"></a>';
                                echo '<a href="' .
                                    route('change.language', ['lang' => 'ca']) .
                                    '"><img src="' .
                                    asset('images/ca-flag.svg') .
                                    '" alt="Catalán"></a>';
                                break;
                            case 'en':
                                echo '<a href="' .
                                    route('change.language', ['lang' => 'es']) .
                                    '"><img src="' .
                                    asset('images/es-flag.svg') .
                                    '" alt="Spanish"></a>';
                                echo '<a href="' .
                                    route('change.language', ['lang' => 'ca']) .
                                    '"><img src="' .
                                    asset('images/ca-flag.svg') .
                                    '" alt="Catalonian"></a>';
                                break;
                            case 'ca':
                                echo '<a href="' .
                                    route('change.language', ['lang' => 'es']) .
                                    '"><img src="' .
                                    asset('images/es-flag.svg') .
                                    '" alt="Espanyol"></a>';
                                echo '<a href="' .
                                    route('change.language', ['lang' => 'en']) .
                                    '"><img src="' .
                                    asset('images/uk-flag.svg') .
                                    '" alt="Anglès"></a>';
                                break;
                        }
                    @endphp
                </div>
            </div>
        </div>
        @if (Auth::check() && (Auth::user()->role === null || Auth::user()->role === 'restaurant'))
            <br>
        @else
            <div class="shopCart">
                <a href="{{ route('cart.index') }}">
                    <i class="fa-solid fa-cart-shopping"></i>
                    @php
                        $cartQuantity = session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0;
                    @endphp
                    <span class="cart-count">{{ $cartQuantity }}</span>
                </a>
            </div>
        @endif
        <div class="user-icon">
            <div class="dropdown">
                @auth
                    @if (Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="avatar">
                    @else
                        <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatar">
                    @endif
                @endauth
                @guest
                    <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatar">
                @endguest
                <div class="dropdown-content" id="dropdownContent">
                    @auth
                        <a href="{{ route('user.index') }}">{{ __('Perfil') }}</a>
                        @if (Auth::check())
                            <a href="{{ route('orders.index') }}">{{ __('Mis pedidos') }}</a>
                        @endif
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('restaurant.create') }}">{{ __('Crear nuevo restaurante') }}</a>
                        @endif
                        <a href="{{ route('logout') }}">{{ __('Cerrar sesión') }}</a>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                        <a href="{{ route('usrSignup') }}">{{ __('Registrarse') }}</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
    <div class="header-bot">
        <div class="link-box">
            <a href="{{ route('principal') }}">{{ __('Inicio') }}</a>
        </div>
        <div class="divider"></div>
        <div class="link-box">
            <a href="{{ route('map') }}">{{ __('Mapa') }}</a>
        </div>
    </div>
</header>
