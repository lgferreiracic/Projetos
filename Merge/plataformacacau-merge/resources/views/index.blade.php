<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="description" content="Plataforma para armazenamento e consulta de dados de lavouras cacaueiras da Bahia">
		<meta name="keywords" content="plataformacacau, uesc, agro, sistema, web, aplicação, cacau, dados, agricultura, tecnologia, cocoa, data, tecnology">
		<meta name="robots" content="index, follow">
		<meta name="revisit-after" content="content='3 days'">

		<title>{{ config('app.name', 'PlataformaCacau') }}</title>
		<link rel="icon" href="{{ asset('img/agrocacau_logo.png') }}">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
		<link rel="stylesheet" href="//unpkg.com/leaflet/dist/leaflet.css" />
    <script src="//unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="//unpkg.com/vue2-leaflet"></script>
	</head>

	<body>
		<div id="app">
			@include('components.navbar')

			<home></home>

			<footer-component></footer-component>
		</div>
		<script src="{{ asset('js/app.js') }}"></script>
		<script>
			window.onscroll = function() {
				scrollFunction()
			};

			// Navbar scroll
			function scrollFunction() {
				if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
					document.querySelector(".navbar-hidden").style.top = "0";
				} else {
					document.querySelector(".navbar-hidden").style.top = "-65px";
				}
			}
		</script>
	</body>
</html>
