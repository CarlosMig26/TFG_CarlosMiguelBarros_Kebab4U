<!DOCTYPE html>
<html lang="{{Session::get('locale')}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/c65fe02a5c.js" crossorigin="anonymous"></script>
    <title>
        @yield('title')
    </title>
</head>

<body @yield('bodyClass')>

    @if (Auth::check() && Auth::user()->role === 'deliveryman')
        @include('partials.deliveryHeader')
    @else
        @include('partials.header')
    @endif

    <main @yield('mainClass')>
        @yield('content')
    </main>
    @include('partials.footer')
</body>

</html>
