@extends('layouts.app')


@section('content')
    <div class="container  py-5">
        <h6>Overview</h6>
        <h2>Profilo utente</h2>
        <div class="row">

            {{-- --------------------------------- CONTAINER DEI DATI DEL DOTTORE --------------------------------- --}}
            <div class="col-12 col-md-12 col-lg-5">
                <div class="ms_card d-flex flex-column  justify-content-center">

                    <div class="ms_image d-flex justify-content-center py-3 ">

                        <div class="ms_wrapper position-relative">

                            <form action="" {{-- method="POST" --}}>
                                {{-- @method('PATCH')
                        @csrf --}}
                                @if ($user->image)
                                    <img class="rounded-circle circle" src="{{ asset('storage/' . $user->image) }}" alt="">
                                @else
                                    <img class="rounded-circle circle"
                                        src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="">
                                @endif
                                {{-- <input name="image"
                                    class="image-upload position-absolute @error('image') is-invalid @enderror form-control-file"
                                    id="image" type="file" onchange="this.form.submit()" /> --}}
                            </form>

                        </div>

                    </div>

                    <div class="box-info p-2">
                        <div class="py-2 d-flex align-items-center border-bottom">
                            <div class="w-50">
                                <p class="font-weight-bold">Nome:</p>
                            </div>
                            <div>
                                <span class="ml-3">{{ $user->name }}</span>
                            </div>

                        </div>

                        <div class="py-2 d-flex align-items-center border-bottom">
                            <div class="w-50">
                                <p class="font-weight-bold">Specializzazione Primaria:</p>
                            </div>
                            <div>
                                <span class="ml-3">{{ $user->titles[0]->name }}</span>
                            </div>

                        </div>

                        <div class="py-2 d-flex align-items-center border-bottom">
                            <div class="w-50">
                                <p class="font-weight-bold">Email:</p>
                            </div>
                            <div>
                                <span class="ml-3">{{ $user->email }}</span>
                            </div>
                        </div>

                        <div class="py-2 d-flex align-items-center border-bottom">
                            <div div class="w-50">
                                <p class="font-weight-bold">Cellulare:</p>
                            </div>
                            <div>
                                @if ($user->phone_n)
                                    <span class="ml-3">{{ $user->phone_n }}</span>
                                @else
                                    <div class="px-2"></div>
                                @endif
                            </div>
                        </div>

                        <div class="py-2 d-flex align-items-center border-bottom">
                            <div div class="w-50">
                                <p class="font-weight-bold">Indirizzo:</p>
                            </div>
                            <div>
                                <span class="ml-3">{{ $user->address }}</span>
                            </div>
                        </div>
                        <div class="py-2 border-bottom">
                            <p class="font-weight-bold">Titoli</p>
                            <div class="d-flex flex-wrap">
                                @foreach ($user->titles as $title)
                                    <div class="badge ms_badge text-white badge-secondary mr-2 mt-2">
                                        {{ $title->name ? $title->name : '-' }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="py-2 border-bottom">
                            <p class="font-weight-bold">Prestazioni</p>
                            <div class="d-flex flex-wrap">
                                @forelse ($user->performances as $performance)
                                    <div class="badge ms_badge text-white mr-2 mt-2">
                                        {{ $performance->name ? $performance->name : '-' }}</div>
                                @empty
                                    <p>aggiungi le tue prestazioni</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <a class="d-block d-lg-none mt-3" href="{{ route('admin.user.edit', Auth::id()) }}"><button
                                class="btn ms_buttonblue btn-primary p-2 mx-2">Modifica Profilo</button></a>
                        <a class="mt-3" href="{{ route('admin.payment', Auth::id()) }}"><button
                                class="btn ms_buttonblue  text-white p-2">Sponsorizza il tuo profilo</button></a>
                    </div>
                </div>
            </div>

            {{-- --------------------------------- FORM MODIFICA PROFILO --------------------------------- --}}
            <div class="d-none d-lg-block col-12 col-md-7">
                <div class="ms_card p-2">
                    <h1>Modifica il tuo profilo</h1>
                    <form action="{{ route('admin.user.update', auth()->user()) }}" method="POST"
                        enctype="multipart/form-data" role="form">

                        @method('PUT')
                        @csrf

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="name" class="form-label">Aggiungi Nome</label>
                                <input type="text" name="name" value="{{ old('name') ?? $user->name }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Inserisci il tuo nome" />
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="form-group col-md-6">
                                <label for="surname" class="form-label">Aggiungi Cognome</label>
                                <input type="text" name="surname" value="{{ old('surname') ?? $user->surname }}"
                                    class="form-control @error('surname') is-invalid @enderror"
                                    placeholder="Inserisci il tuo cognome" />
                                @error('surname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>


                        <div class="form-group ">
                            <label for="date" class="form-label">Aggiungi Data di nascita</label>
                            <input type="date" id="start" name="birth_date"
                                value="{{ old('date') ?? $user->birth_date }}">
                            @error('date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="address" class="form-label">Aggiungi Via</label>
                                <input style="border-style: solid;
                                        background-color: {{ $user->address == '' ? 'black' : 'white' }} " type="text"
                                    name="address" value="{{ old('address') ?? $user->address }}"
                                    class="form-control @error('address') is-invalid @enderror"
                                    placeholder="Inserisci la tua via" />
                                @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="phone_n" class="form-label">Aggiungi Numero di telefono</label>
                                <input
                                    style="border-style: solid;
                                        background-color: {{ $user->phone_n == '' ? 'rgba(255, 0, 0, 0.3)' : 'white' }} "
                                    type="text" name="phone_n" value="{{ old('phone_n') ?? $user->phone_n }}"
                                    class="form-control @error('phone_n') is-invalid @enderror"
                                    placeholder="Inserisci il tuo numero" />
                                @error('phone_n')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Modifica email</label>
                                <input type="text" name="email" value="{{ old('email') ?? $user->email }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Inserisci la tua email" />
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="image">Modifica l'immagine del tuo profilo</label>
                                <input type="file" name="image"
                                    class="@error('image') is-invalid @enderror form-control-file" id="image">
                            </div>
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cv">Aggiungi il tuo cv</label>
                            <textarea name="cv" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Inserisci il tuo cv"
                                class="form-control bcontent">{{ old('cv') ?? $user->cv }}</textarea>
                            @error('cv')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <h4>Titoli</h4>
                        <div class="ms_boxinput d-flex flex-wrap">
                            @foreach ($titles as $title)
                                <div class="form-check mx-1">
                                    <input class="ms_checkbox form-check-input" type="checkbox" value="{{ $title->id }}"
                                        name="titles[]" id="{{ $title->id }}"
                                        {{ $user->titles->contains($title) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $title->id }}">
                                        {{ $title->name }}
                                    </label>
                                    @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>


                        <h4>Prestazioni</h4>
                        <div class="ms_boxinput d-flex flex-wrap w-75">
                            @foreach ($performances as $performance)
                                <div class="form-check mx-1">
                                    <input class="ms_checkbox form-check-input" type="checkbox"
                                        value="{{ $performance->id }}" name="performances[]"
                                        id="{{ $performance->id }}"
                                        {{ $user->performances->contains($performance) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $performance->id }}">
                                        {{ $performance->name }}
                                    </label>
                                    @error('performance')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>


                        <div class="form-group">
                            <input value="Modifica" class="ms_buttonblue text-white text-center  form-control"
                                data-toggle="modal" data-target="#exampleModalCenter" />
                        </div>
                        {{-- ------------------------------------ MODAL -------------------------------------------- --}}
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Sicuro di voler modificare il
                                            profilo?</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary w-100"
                                            data-dismiss="modal">Indietro</button>
                                        <input type="submit" name="Submit" value="Modifica"
                                            class="ms_buttonblue text-white  form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
