<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/padre-layaout.css') }}">
    @vite('resources/css/app.css')
    @yield('header')
</head>

<body>
    @yield('modal')
    <div class="contenedor scrollbar">
        @include('nav-layaout')
    @yield('content')
    </div>
    @yield('js')
</body>
</html>
