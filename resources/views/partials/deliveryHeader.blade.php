<header class="head">
    <div class="header-top">
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
        <div class="delivery">
            <h2>Sección de Repartidores</h2>
        </div>
        <div class="user-icon">
            <div class="dropdown">
                @if (Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="avatar">
                @else
                    <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatar">
                @endif
                <div class="dropdown-content" id="dropdownContent">
                    <a href="{{ route('delivery.profile') }}">{{ __('Perfil') }}</a>
                    <a href="{{ route('logout') }}">{{ __('Cerrar sesión') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bot">
        <div class="link-box">
            <a href="{{ route('delivery') }}">Principal</a>
        </div>
</header>
