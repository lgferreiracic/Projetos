<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Plataforma para armazenamento e consulta de dados de lavouras cacaueiras da Bahia">
    <meta name="keywords"
        content="plataformacacau, uesc, agro, sistema, web, aplicação, cacau, dados, agricultura, tecnologia, cocoa, data, tecnology">
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="content='3 days'">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PlataformaCacau | Cadastro') }}</title>
    <link rel="icon" href="{{ asset('img/agrocacau_logo.png') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">

    <link rel="stylesheet" href="//unpkg.com/leaflet/dist/leaflet.css" />
    <script src="//unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="//unpkg.com/vue2-leaflet"></script>
</head>

<body>
    <div id="app" class="signup-box">
        <section class="h-100">
            <router-view></router-view>
        </section>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
