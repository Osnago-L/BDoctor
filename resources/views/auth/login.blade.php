@extends('layouts.app')

@section('content')

<div class="container py-5">
    {{-------------------------- VECCHIO LOGIN ---------------------------------}}
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Ricordami') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Accedi') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Password dimenticata?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- ////////////////////////////////////////////////////////////////// --}}
    {{-------------------------- NUOVO LOGIN ---------------------------------}}
    <div class="row justify-content-center ">
        <form class="form col-6 mr-5" method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="title">Benvenuto</div>
            <div class="subtitle">Fai il login!</div>
            
            <div class="input-container ic1">
                <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder=" " required autocomplete="email" autofocus />
                <div class="cut cut-short"></div>
                <label for="email" class="placeholder">{{ ('E-Mail') }}</label>
    
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    
            <div class="input-container ic1">
                <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" placeholder=" " required autocomplete="current-password">
                <div class="cut"></div>
                <label for="password" class="placeholder">{{ ('Password') }}</>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    
            <div class="form-group row">
                <div class="col-md-6 my-2">
                    <div class="form-check">
                        <input class="ms_checkbox form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-white" for="remember">
                            {{ __('Ricordami') }}
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="form-group row mb-0">
                <div class="col-md-12">
                    <button type="submit" class="ms_buttonform text-white px-3">
                        {{ __('Accedi') }}
                    </button>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link text-white" href="{{ route('password.request') }}">
                            {{ __('Password dimenticata?') }}
                        </a>
                    @endif
                </div>
            </div>
            <div class="py-3 text-white">
                Non hai un account?<a class="text-white px-2" href="{{ route('register') }}">Registrati!</a>
            </div>
        </form>
    </div>
    
@endsection
