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
            <nav> 
                <div class="ms_front_nav">
                    <div>
                        <img src="{{asset("/img/"."logo_inverted.png")}}" alt="">
                        <a class="text-white" href="{{ url('/') }}">Home</a>
                        <a class="text-white"href="{{ url('/search') }}">Ricerca</a>
                    </div>
                    <div>
                        @if (Route::has('login'))
                            <div>
                                @auth
                                    <button class="btn btn-secondary btn-sm"><a href="{{ url('/admin/') }}">Home</a></button>
                                @else
                                    <button class="btn button_ms_yellow btn-sm"><a href="{{ route('login') }}">Accedi</a></button>
                                    @if (Route::has('register'))
                                        <button class="btn button_ms_yellow  btn-sm"><a href="{{ route('register') }}">Registrati</a></button>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </nav>
                <div id="app"></div>
            </div>
        </div>
    </body>
</html>
