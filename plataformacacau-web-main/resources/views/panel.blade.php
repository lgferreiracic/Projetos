<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Plataforma para armazenamento e consulta de dados de lavouras cacaueiras da Bahia">
    <meta name="keywords" content="cacau, dados, agricultura, tecnologia, cocoa, data, tecnology">
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="content='3 days'">

    <title>{{ __('PlataformaCacau | Painel') }}</title>
    <link rel="icon" href="{{ asset('img/agrocacau_logo.png') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/add-property.css') }}">
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">

    <link rel="stylesheet" href="//unpkg.com/leaflet/dist/leaflet.css" />
    <script src="//unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="//unpkg.com/vue2-leaflet"></script>

    <script>
        @auth
        window.user = @json(auth()->user());
        window.Roles = {!! json_encode(Auth::user()->roles, true) !!};
        window.token = `{{ Cookie::get('token') }}`;
        @else
            window.user = null;
            window.Roles = null;
            window.token = null;
            window.Roles = []
        @endauth
    </script>
</head>

<body>
    <div id="app" class="wrapper d-flex">
        <sidebar></sidebar>
        <div style="width: 100%; padding: 0 20px">
            <profile-button name="{{ Auth::user()->name }}"></profile-button>
            <div id="content">
                <router-view></router-view>
            </div>
        </div>
        <bottom-tab></bottom-tab>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
