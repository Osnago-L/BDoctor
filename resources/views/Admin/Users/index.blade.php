@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="col-12">

            @if (session()->has('success_message'))
                <div class=" alert alert-success my-3 ms_success">
                    {{ session()->get('success_message') }}
                </div>
            @elseif (session()->has('error_message'))
                <div class=" alert alert-warning my-3 ms_success">
                    {{ session()->get('error_message') }}
                </div>
            @endif
        </div>
        <h1 class="py-4">Profilo di {{ $user->name }}</h1>
        <div class="row align-items-end">
            <div class="col-12 col-md-6 p-2">

                @if (session()->has('message'))
                    <div class=" alert alert-success my-3 ms_success">
                        {{ session()->get('message') }}
                    </div>
                @endif

                <div class="ms_card d-flex flex-column  justify-content-center">

                    <div class="ms_image d-flex justify-content-center py-3">
                        <div class="ms_image d-flex justify-content-center py-3">
                            @if ($user->image)
                                <img class="rounded-circle circle" src="{{ asset('storage/' . $user->image) }}" alt="">
                            @else
                                <img class="rounded-circle circle" src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                                    alt="">
                            @endif
                        </div>
                    </div>

                    <div class="box-info p-2">
                        <div class="py-2 d-flex align-items-center border-bottom">
                            <div class=" w-25">
                                <p class="font-weight-bold">Nome:</p>
                            </div>
                            <div>
                                <span class="ml-3">{{ $user->name }}</span>
                            </div>
                        </div>

                        <div class="py-2 d-flex align-items-center border-bottom">
                            <div class="w-25">
                                <p class="font-weight-bold">Specializzazione:</p>
                            </div>
                            <div>
                                <span class="ml-3">{{ $user->titles[0]->name }}</span>
                            </div>
                        </div>

                        <div class="py-2 d-flex align-items-center border-bottom">
                            <div class="w-25">
                                <p class="font-weight-bold">Email:</p>
                            </div>
                            <div>
                                <span class="ml-3">{{ $user->email }}</span>
                            </div>
                        </div>

                        <div class="py-2 d-flex align-items-center border-bottom">
                            <div div class="w-25">
                                <p class="font-weight-bold">Cellulare:</p>
                            </div>
                            <div>
                                <span class="ml-3">{{ $user->phone_n }}</span>
                            </div>
                        </div>

                        <div class="py-2 d-flex align-items-center border-bottom">
                            <div div class="w-25">
                                <p class="font-weight-bold">Indirizzo:</p>
                            </div>
                            <div>
                                <span class="ml-3">{{ $user->address }}</span>
                            </div>
                        </div>
                        <div class="py-2 border-bottom">
                            <p class="font-weight-bold">Titoli</p>
                            <div class="d-flex">
                                @foreach ($user->titles as $title)
                                    <div class="badge ms_badge text-white mr-2 mt-2">
                                        {{ $title->name ? $title->name : '-' }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="py-2 border-bottom">
                            <p class="font-weight-bold">Prestazioni</p>
                            <div class="d-flex">
                                @forelse ($user->performances as $performance)
                                    <div class="badge ms_badge text-white mr-2 mt-2">
                                        {{ $performance->name ? $performance->name : '-' }}</div>
                                @empty
                                    <p>Aggiungi le tue prestazioni</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <a class="mt-3" href="{{ route('admin.payment', Auth::id()) }}"><button
                            class="btn ms_buttonblue  text-white">Sponsorizza il tuo profilo</button></a>
                </div>
            </div>


            <div class="col-12 col-md-6 p-2">
                {{-- <h1 class="py-4">Sponsorizzazioni attive</h1> --}}
                <div class="ms_card">

                    <div class="d-flex justify-content-between">
                        <p>le tue sponsorizzazioni</p>
                        <p>Scadenza</p>
                    </div>

                    @forelse ($user->sponsorships as $element)
                        <div class="ms_box my-2 p-2 d-flex align-items-center justify-content-between">

                            <div>
                                <h3>{{ $element->name }}</h3>
                            </div>

                            <div>
                                <p>{{ $element->pivot->expiration }}</p>
                            </div>

                        </div>
                    @empty
                        <div class="text-center py-5">
                            <h3>Mi dispiace non hai sponsorizzazioni!</h3>
                        </div>
                    @endforelse

                </div>

            </div>


        </div>
    </div>
@endsection
