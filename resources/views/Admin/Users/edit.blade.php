@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1>Modifica il tuo profilo</h1>
        <div class="ms_card p-3">

            <form action="{{ route('admin.user.update', auth()->user()) }}" method="POST" enctype="multipart/form-data"
                role="form">

                @method('PUT')
                @csrf



                <div class="form-group">
                    <label for="name" class="form-label">
                        <h4>Aggiungi Nome</h4>
                    </label>
                    <input type="text" name="name" value="{{ old('name') ?? $user->name }}"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Inserisci il tuo nome" />
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="surname" class="form-label">
                        <h4>Aggiungi Cognome</h4>
                    </label>
                    <input type="text" name="surname" value="{{ old('surname') ?? $user->surname }}"
                        class="form-control @error('surname') is-invalid @enderror" placeholder="Inserisci il tuo cognome" />
                    @error('surname')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="date" class="form-label">
                        <h4>Aggiungi Data di nascita</h4>
                    </label>
                    <input type="date" id="start" name="birth_date" value="{{ old('date') ?? $user->birth_date }}">
                    @error('date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address" class="form-label">Aggiungi Via</label>
                    <input type="text" name="address" value="{{ old('address') ?? $user->address }}"
                        class="form-control @error('address') is-invalid @enderror" placeholder="Inserisci la tua via" />
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone_n" class="form-label">
                        <h4>Aggiungi Numero di telefono</h4>
                    </label>
                    <input type="text" name="phone_n" value="{{ old('phone_n') ?? $user->phone_n }}"
                        class="form-control @error('phone_n') is-invalid @enderror" placeholder="Inserisci il tuo numero" />
                    @error('phone_n')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="cv">
                        <h4>Aggiungi il tuo cv</h4>
                    </label>
                    <textarea name="cv" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Inserisci il tuo cv"
                        class="form-control bcontent">{{ old('cv') ?? $user->cv }}</textarea>
                    @error('cv')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <h3>Titolo</h3>
                <div class="form-group d-flex flex-wrap">
                    @foreach ($titles as $title)
                        <div class="form-check p-3">
                            <input class="form-check-input" type="checkbox" value="{{ $title->id }}" name="titles[]"
                                id="{{ $title->id }}" {{ $user->titles->contains($title) ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ $title->id }}">
                                {{ $title->name }}
                            </label>
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                </div>
                <h3>performance</h3>
                <div class="form-group d-flex flex-wrap">
                    @foreach ($performances as $performance)
                        <div class="form-check p-3">
                            <input class="form-check-input" type="checkbox" value="{{ $performance->id }}"
                                name="performances[]" id="{{ $performance->id }}"
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
                    <label for="email">
                        <h4>Modifica email</h4>
                    </label>
                    <input type="text" name="email" value="{{ old('email') ?? $user->email }}"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Inserisci la tua email" />
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="image">
                        <h4>Modifica l'immagine del tuo profilo</h4>
                    </label>
                    <input type="file" name="image" class="@error('image') is-invalid @enderror form-control-file"
                        id="image">
                </div>

                <div class="form-group">
                    <input value="Modifica" class="ms_buttonblue btn btn-primary form-control"
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
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">Indietro</button>
                                <input type="submit" name="Submit" value="Modifica"
                                    class="ms_buttonblue text-white  form-control" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
