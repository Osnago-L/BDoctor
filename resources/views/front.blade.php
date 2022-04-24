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
            <nav class="ms_front_nav navbar navbar-expand-lg navbar-dark d-flex align-items-center">
                <img class="d-none d-lg-inline" src="{{asset("/img/"."logo_inverted.png")}}" alt="">
                <img class="d-inline d-lg-none" src="{{asset("/img/"."logo_inverted_B.png")}}" alt="">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav w-100 d-lg-flex justify-content-lg-between">
                    <div class="d-lg-flex align-items-lg-center mt-sm-2">
                        <li class="nav-item active mx-lg-5">
                            <a class="nav-link text-white" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white"href="{{ url('/search') }}">Ricerca</a>
                        </li>
                    </div>
                    <div class="d-lg-flex align-items-lg-center mt-sm-2">
                        @if (Route::has('login'))
                                @auth
                                    <li class="nav-item mb-sm-2 mb-md-0 mx-lg-5">
                                        <button class=" btn btn-secondary btn-sm "><a class="text-dark" href="{{ url('/admin/') }}">Home</a></button>
                                    </li> 
                                @else
                                    <li class="nav-item mb-sm-2 mb-lg-0">
                                        <button class="  btn button_ms_yellow btn-sm text-dark"><a class="text-dark" href="{{ route('login') }}">Accedi</a></button>
                                    </li> 
                                    @if (Route::has('register'))
                                        <li class="nav-item mb-sm-2 mb-lg-0 mx-lg-2">
                                            <button class="btn button_ms_yellow btn-sm text-dark"><a class="text-dark" href="{{ route('register') }}">Registrati</a></button>
                                        </li> 
                                    @endif
                                @endauth
                        @endif
                    </div>
                  </ul>
                </div>
            </nav>
            {{-- <nav> 
                <div class="ms_front_nav">
                    <div class="d-flex align-items-center">
                        <img class="d-none d-sm-inline" src="{{asset("/img/"."logo_inverted.png")}}" alt="">
                        <img class="d-inline d-sm-none" src="{{asset("/img/"."logo_inverted_B.png")}}" alt="">
                        
                        
                    </div>
                    <div>

                    </div>
                </div>
            </nav> --}}
                <div id="app"></div>
            </div>
        </div>
    </body>
</html>
