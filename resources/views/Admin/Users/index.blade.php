@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            
            @if(session()->has('message'))
                <div class=" alert alert-success my-3 ms_success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <h1 class="py-4">Profilo di {{$user->name}}</h1>
            <div class="ms_card d-flex flex-column  justify-content-center">
                
                <div class="ms_image d-flex justify-content-center py-3">
                    <img  class="rounded-circle " src="{{ asset('storage/' . $user->image) }}" alt="">
                </div>

                <div class="box-info p-2">
                    <div class="py-2 d-flex align-items-center">
                        <p>Nome:</p><span>{{$user->name}}</span>
                    </div>
    
                    <div class="py-2 d-flex align-items-center">
                        <p>Email:</p><span>{{$user->email}}</span>
                    </div>
    
                    <div class="py-2 d-flex align-items-center">
                        <p>Cellulare:</p><span>{{$user->phone_n}}</span>
                    </div>
    
                    <div class="py-2 d-flex align-items-center">
                        <p>Indirizzo:</p><span>{{$user->address}}</span>
                    </div>
    
                    <p>Titoli</p>
                    <div class="d-flex">
                        @foreach($user->titles as $title)
                        <div class="badge badge-secondary mr-2 mt-2">{{$title->name ? $title->name : '-'}}</div>
                        @endforeach
                    </div>
                    
                    <p>Prestazioni</p>
                    <div class="d-flex">
                        @foreach($user->performances as $performance)
                        <div class="badge badge-danger mr-2 mt-2">{{$performance->name ? $performance->name : '-'}}</div>
                        @endforeach
                    </div>
                </div>
        </div>
        <a class="mt-3" href="{{route("admin.payment",Auth::id())}}"><button class="btn btn-primary my-5">Sponsorizza il tuo profilo</button></a>
    </div>
</div>

@endsection
