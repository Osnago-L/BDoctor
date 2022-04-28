<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BDoctor</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/guest.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/guest.css') }}" rel="stylesheet">
</head>

<body>
    <div class="overflow">
        <nav class="ms_front_nav navbar navbar-expand-lg navbar-dark d-flex justify-content-between">
            <a href="{{ url('/') }}">
                <img class="d-none d-lg-inline" src="{{ asset('/img/' . 'logo_inverted.png') }}" alt="">
                <img class="d-inline d-lg-none" src="{{ asset('/img/' . 'logo_inverted_B.png') }}" alt="">
            </a>
            <div class="">
                <ul class="navbar-nav w-100 d-flex align-items-center">
                    <div class="d-flex align-items-center mt-lg-0">
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item mb-sm-2 mb-md-0">
                                    <div class="ms_imagebox">
                                        @if($user->image)
                                        <a class="text-dark" href="{{ url('/admin/') }}" ><img  src="{{ asset('storage/' . $user->image) }}" alt=""></a>
                                        @else
                                        <a class="text-dark" href="{{ url('/admin/') }}" ><img  src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt=""></a>
                                        @endif
                                    </div>
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
        <div id="app"></div>
    </div>
    </div>
</body>

</html>
