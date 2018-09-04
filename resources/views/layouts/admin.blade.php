<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Админка</title>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/admin.css" rel="stylesheet">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>
<div id="app">
	<nav class="navbar navbar-default navbar-expand-md navbar-light navbar-laravel">
		<div class="container">
			<a class="navbar-brand" href="{{ route('index') }}">
				Вернуться на сайт
			</a>

			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li @if(Route::is('admin.categories*')) class="active" @endif><a
								href="{{ route('admin.categories.index') }}">Категории</a></li>
					<li @if(Route::is('admin.products*')) class="active" @endif><a href="{{ route('admin.products.index') }}">Товары</a>
					</li>
					<li @if(Route::is('admin.orders*')) class="active" @endif><a href="{{ route('admin.orders.index') }}">Заказы</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@guest
						<li class="nav-item">
							<a class="nav-link" href="{{ route('login') }}">Войти</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('register') }}">Зарегистрироваться</a>
						</li>
					@else
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
							   aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->name }}
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('logout') }}"
								   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
									Выйти
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

	<div class="py-4">
		<div class="container">
			@if(session()->has('success'))
				<p class="alert alert-success">{{ session()->get('success') }}</p>
			@endif
			@if(session()->has('warning'))
				<p class="alert alert-warning">{{ session()->get('warning') }}</p>
			@endif
			@yield('content')
		</div>
	</div>
</div>
</body>
</html>
