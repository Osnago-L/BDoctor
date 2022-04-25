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
        {{-- <div class="ms_header d-flex justify-content-between">
            <div>
                <h2 class="text-white p-2">BDoctor</h2>
            </div>
            @if (!Auth::user())
            <div class="d-flex align-items-center">
                <a class="text-white p-2" href="{{ route('login') }}">Accedi</a>
                <a class="text-white p-2" href="{{ route('register') }}">Registrati</a>
            </div>
            @endif
        </div> --}}
        {{-------------------------- SIDEBAR FOR LOGGED USERS ---------------------------------}}
        @if ( Auth::user())
        <div class="ms_nav">
                <p class="ms_title p-3 d-none d-lg-block">Bdoctor Dashboard</p>
                <div class="nav-item">
                    <img class="d-block d-lg-none" src="{{ asset('img/' . "logo.png") }}" alt="">
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
            <div class="box">
                @yield('content')
            </div>
        </main>

    </div>
    
</body>

</html>
