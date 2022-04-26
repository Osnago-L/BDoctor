<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BDoctor') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body>
    <div id="app">
        {{-------------------------- HEADER ---------------------------------}}
        <nav class="ms_front_nav navbar navbar-expand-lg navbar-dark d-flex justify-content-between">
            <a href="{{ url('/') }}">
                <img class="d-none  d-lg-inline" src="{{ asset('/img/' . 'logo_inverted.png') }}" alt="">
                <img class="d-inline w-75 d-lg-none" src="{{ asset('/img/' . 'logo_inverted_B.png') }}" alt="">
            </a>
            <div class="">
                <ul class="navbar-nav w-100 d-flex align-items-center">
                    <div class="d-flex align-items-center mt-sm-2 mt-lg-0">
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item mb-sm-2 mb-md-0 mx-5">
                                    <button class=" btn button_ms_yellow btn-sm text-dark"><a class="text-dark"
                                            href="{{ url('/admin/') }}">Home</a></button>
                                </li>
                            @else
                                <li class="nav-item mb-sm-2 mb-lg-0">
                                    <button class="  btn button_ms_yellow btn-sm text-dark"><a class="text-dark"
                                            href="{{ route('login') }}">Accedi</a></button>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item mb-sm-2 mb-lg-0 mx-2">
                                        <button class="btn button_ms_yellow btn-sm text-dark"><a class="text-dark"
                                                href="{{ route('register') }}">Registrati</a></button>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </div>
                </ul>
            </div>
        </nav>
        {{-------------------------- SIDEBAR FOR LOGGED USERS ---------------------------------}}
        @if ( Auth::user())
        <div class="ms_leftnav">
                {{-- <p class="ms_title p-3 d-none d-lg-block">Bdoctor</p> --}}
                <div class="nav-item">
                    {{-- <img class="d-block d-lg-none" src="{{ asset('img/' . "logo.png") }}" alt=""> --}}
                    <div class="ms_boxnav d-flex flex-column">
                        <a href="{{route("admin.home")}}"><i class="fa-solid fa-house-user"></i><p class="d-none d-lg-block">Home</p></a>
                        <a href="{{route("admin.user.index")}}"><i class="fa-solid fa-user"></i><p class="d-none d-lg-block">Profilo</p></a>
                        <a href="{{route("admin.messages.index",Auth::user()->id)}}"><i class="fa-solid fa-inbox"></i><p class="d-none d-lg-block">Messaggi</p></a>
                        <a href="{{route("admin.reviews.index",Auth::user()->id)}}"><i class="fa-solid fa-comment"></i><p class="d-none d-lg-block">Recensioni</p></a>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket"></i><p class="d-none d-lg-block">{{ __('Logout') }}</p>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            @endif
        </div>

        <main>
            <div class="box p-4">
                @yield('content')
            </div>
        </main>

    </div>
    
</body>

</html>
