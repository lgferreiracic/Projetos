<header>
	<nav class="navbar navbar-main navbar-expand-md navbar-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="{{ url('/') }}">
				<img src="/img/logo.png" alt="Logo AgroCacau">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarContent">
				<!-- Left Side Of Navbar -->
				<ul class="navbar-nav mr-auto"></ul>

				<!-- Right Side Of Navbar -->
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a href="#banner" class="nav-link">{{ __('Início') }}</a></li>
					<li class="nav-item"><a href="#about" class="nav-link">{{ __('Sobre') }}</a></li>
					<li class="nav-item"><a href="#team" class="nav-link">{{ __('Envolvidos') }}</a></li>
					<li class="nav-item"><a href="#contact" class="nav-link">{{ __('Contato') }}</a></li>
					<li class="nav-item"><a href="/signup" target="_blank" class="nav-link">{{ __('Cadastro do cacauicultor') }}</a></li>

					@guest
						<li class="nav-item">
							<a class="nav-link btn px-5" href="{{ route("login") }}">{{ __('Login') }}</a>
						</li>
					@else
						<li class="nav-item dropdown">
							<a id="userDropdown" class="nav-link dropdown-toggle btn" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="{{ route('panel') }}">{{ __('Painel') }}</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ route('logout') }}"
								onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</div>
						</li>
					@endguest
				</ul>
			</div>
		</div>
	</nav>

	<nav class="navbar navbar-hidden navbar-expand-md navbar-light bg-white shadow-sm">
		<div class="container-fluid">
			<a class="navbar-brand" href="{{ url('/') }}">
				{{-- {{ config('app.name', 'AgroCacau') }} --}}
				<img src="/img/logo.png" alt="Logo AgroCacau">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarContent">
				<!-- Left Side Of Navbar -->
				<ul class="navbar-nav mr-auto"></ul>

				<!-- Right Side Of Navbar -->
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a href="#banner" class="nav-link">{{ __('Início') }}</a></li>
					<li class="nav-item"><a href="#about" class="nav-link">{{ __('Sobre') }}</a></li>
					<li class="nav-item"><a href="#team" class="nav-link">{{ __('Envolvidos') }}</a></li>
					<li class="nav-item"><a href="#contact" class="nav-link">{{ __('Contato') }}</a></li>
					<li class="nav-item"><a href="/signup" target="_blank" class="nav-link">{{ __('Cadastro do cacauicultor') }}</a></li>

					@guest
						<li class="nav-item">
							<a class="nav-link btn px-5" href="{{ route("login") }}">{{ __('Login') }}</a>
						</li>
					@else
						<li class="nav-item dropdown">
							<a id="userDropdown" class="nav-link dropdown-toggle btn" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="{{ route('panel') }}">{{ __('Painel') }}</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ route('logout') }}"
								onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</div>
						</li>
					@endguest
				</ul>
			</div>
		</div>
	</nav>
</header>
