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
        <nav> 
            <div class="ms_front_nav">
                <div>
                    <a href="{{ url('/') }}">Home</a>
                    <a href="{{ url('/search') }}">Ricerca</a>
                </div>
                <div>
                    @if (Route::has('login'))
                        <div>
                            @auth
                                <a href="{{ url('/admin/') }}">Home</a>
                            @else
                                <a href="{{ route('login') }}">Accedi</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Registrati</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>
            <div id="app"></div>
        </div>
    </body>
</html>
