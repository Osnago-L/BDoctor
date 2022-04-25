@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">

    {{-- ~~~~~~~~~~~~~~~~~~~~~~~~~ VECCHIO LOGIN ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ --}}
    {{-- <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="surname" class="col-md-4 col-form-label text-md-right">Cognome</label>

                <div class="col-md-6">
                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                    @error('surname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">Indirizzo</label>

                <div class="col-md-6">
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="">Specializzazione Primaria</label>
                <select name="title_id" id="title_id"   class="form-control @error('title_id') is-invalid @enderror">
                    <option selected>
                        Scegli..
                    </option>
                        @foreach ($titles as $title)
                            <option value="{{ $title->id }}">
                                    {{ $title->name }}
                            </option>
                        @endforeach
                </select>   
                @error('title_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        
            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Conferma Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Registrati
                    </button>
                </div>
            </div>
        </form>
    </div> --}}

    {{-- ~~~~~~~~~~~~~~~~~~~~~~ NUOVO LOGIN ~~~~~~~~~~~~~~~~~~~~~~~ --}}
    <form method="POST" class="form register  mr-5" action="{{ route('register') }}">
        
        <div class="title">Benvenuto!</div>
        <div class="subtitle">Crea un account</div>

        @csrf
        {{----------------------------------- NOME -----------------------------------}}
        <div class="input-container ic1">
            <input id="name" type="text" class="input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder=" " required autocomplete="name" autofocus>
            <div class="cut cut-short"></div>
            <label for="name" class="placeholder">Nome</label>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        {{----------------------------------- COGNOME -----------------------------------}}
        <div class="input-container ic1">
            <input id="surname" type="text" class="input @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" placeholder=" " required autocomplete="surname" autofocus>
            <div class="cut"></div>
            <label for="surname" class="placeholder">Cognome</label>
            @error('surname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        {{----------------------------------- EMAIL -----------------------------------}}
        <div class="input-container ic1">
            <input id="email" type="text" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder=" " required autocomplete="email" autofocus>
            <div class="cut cut-short"></div>
            <label for="email" class="placeholder">Email</label>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        {{----------------------------------- INDIRIZZO -----------------------------------}}
        <div class="input-container ic1">
            <input id="address" type="text" class="input @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" placeholder=" " required autocomplete="address" autofocus>
            <div class="cut"></div>
            <label for="address" class="placeholder">Indirizzo</label>
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        {{----------------------------------- SPECIALIZZAZIONE PRIMARIA -----------------------------------}}
        <div class="form-group py-1">
            <label class="text-white" for="">Specializzazione</label>
            <select name="title_id" id="title_id"   class="input  @error('title_id') is-invalid @enderror">
                <option selected>
                    Scegli..
                </option>
                    @foreach ($titles as $title)
                        <option value="{{ $title->id }}">
                                {{ $title->name }}
                        </option>
                    @endforeach
            </select>   
            @error('title_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        {{----------------------------------- PASSWORD -----------------------------------}}
        <div class="input-container ic1">
            <input id="password" type="password" class="input @error('Password') is-invalid @enderror" name="password"  placeholder=" " required autocomplete="new-password">
            <div class="cut"></div>
            <label for="password" class="placeholder">Password</label>
            @error('Password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        {{----------------------------------- CONFERMA PASSWORD -----------------------------------}}
        <div class="input-container ic1">
            <input id="password-confirm" type="password" class="input"  name="password_confirmation"  placeholder=" " required autocomplete="new-password">
            <div class="cut cut-long"></div>
            <label for="password-confirm" class="placeholder">Conferma Password</label>
        </div>
        {{----------------------------------- BOTTONI -----------------------------------}}
        <div class="form-group row mb-0">
            <div class="col-12  py-2">
                <button type="submit" class="ms_buttonform text-white px-3">
                    Registrati
                </button>
            </div>
            <div class="col-12 px-3 text-white">
                Hai già un account?<a class="text-white px-2" href="{{ route('login') }}">Accedi Subito!</a>
            </div>
        </div>
    
    </form>

    </div>
</div>
@endsection
