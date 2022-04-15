<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token()}}"> <!-- CSRF Token -->

        <title>{{config('app.name', 'BDoctor')}}</title>

        <!-- Scripts -->
        <script src="{{asset('js/app.js')}}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    BDoctor
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        <div class="container-fluid mt-5">
            <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar p-4">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.home')}}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ "#" /* route('admin.profile.index', Auth::user()->id) */ }}">
                                    Il tuo profilo
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('admin.messages.index', Auth::user()->id) }}">
                                    I tuoi messaggi
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ "#" /* route('admin.reviews.index', Auth::user()->id) */ }}">
                                    Dicono di te
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ "#" /* route('admin.sponsorship.index', Auth::user()->id) */ }}">
                                    Sponsorship
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                @yield('content')
            </div>
        </div>

       {{-- <div class="flex-center position-ref full-height">
            <a href="{{ route('admin.home') }}">Home

            </a>
            @if (Route::has('login'))
                    <a href="{{ route('login') }}">
                        Login
                    </a>
                <div class="top-right links">
                    @auth
                        <a href="{{ route('register') }}">
                            Register
                        </a>
                    @else
                        @if (Route::has('register'))
                        @endif
                    @endauth
                </div>
            @endif     
        </div> --}}
    </body>
</html>
