<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('page-title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link rel="icon" href="{{ asset('public/icon.ico') }}">
        <link href="{{ asset('public/css/bt5/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

        <style>
            body { background: #f5f5f5; }
            .navbar-brand { font-size: 1.8em; }
            .nav-item { font-size: 1.2em; }
            .dropdown-item:active { background: #198754; }
            .font-size-my { font-size: 1.1em; }
            @yield('additional-styles')
        </style>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
                <div class="container align-items-center">
                    <a class="navbar-brand" href="/">
                        Web blog
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-md-between" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li>
                                <a href="/" class="nav-link text-dark font-size-my">
                                    Главная
                                </a>
                            </li>
                            <li>
                                <a href="/articles" class="nav-link text-dark font-size-my">
                                    Все статьи
                                </a>
                            </li>
                            <li>
                                <a href="/blog/about" class="nav-link text-dark font-size-my">
                                    Про нас
                                </a>
                            </li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                @if (Route::has('login'))
                                    <a class="btn btn-success mr-2" href="{{ route('login') }}">
                                        Войти
                                    </a>
                                @endif
                                @if (Route::has('register'))
                                    <a class="btn btn-outline-success" href="{{ route('register') }}">
                                        Зарегистрироваться
                                    </a>
                                @endif
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/user/">
                                            Личный кабинет
                                        </a>
                                        <a class="dropdown-item" href="/articles/create">
                                            Новая статья
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Выйти
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container py-4">
                @include('blocks/main_ers')
                @yield('content')
            </div>

            <footer class="bg-white p-3 shadow-sm">
                <div class="container text-center">
                    © 2021, Web blog. При копировании материала ссылка на источник обязательна.
                </div>
            </footer>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('public/js/bt5/bootstrap.min.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        @yield('additional-scripts')
    </body>
</html>
