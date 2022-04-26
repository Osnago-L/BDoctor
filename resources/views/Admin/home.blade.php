@extends('layouts.app')


@section('content')
<div class="container  py-5">
    <h6>Overview</h6>
    <h2>Profilo utente</h2>
    <div class="row">
        
        {{----------------------------------- CONTAINER DEI DATI DEL DOTTORE -----------------------------------}}
        <div class="col-12 col-md-12 col-lg-5">
            <div class="ms_card d-flex flex-column  justify-content-center">
                
                <div class="ms_image d-flex justify-content-center py-3 ">
                    
                    <div class="ms_wrapper position-relative">
                        
                        <form action="" {{-- method="POST" --}}>
                        {{-- @method('PATCH')
                        @csrf --}}
                            <img  class="rounded-circle circle" src="{{ asset('storage/' . $user->image) }}" alt="">
                        
                            <input name="image" class="image-upload position-absolute @error('image') is-invalid @enderror form-control-file" id="image" type="file" onchange="this.form.submit()" />
                        </form>
                        
                    </div>

                </div>

                <div class="box-info p-2">
                    <div class="py-2 d-flex align-items-center border-bottom">
                        <div class="w-25">
                            <p class="font-weight-bold">Nome:</p>
                        </div>
                        <div>
                            <span class="ml-3">{{$user->name}}</span>
                        </div>
                        
                    </div>
    
                    <div class="py-2 d-flex align-items-center border-bottom">
                        <div>
                            <p class="font-weight-bold">Specializzazione:</p>
                        </div>
                        <div>
                            <span class="ml-3">{{$titlesingola->name}}</span>
                        </div>
                        
                    </div>
    
                    <div class="py-2 d-flex align-items-center border-bottom">
                        <div div class="w-25">
                            <p class="font-weight-bold">Email:</p>
                        </div>
                        <div>
                            <span class="ml-3">{{$user->email}}</span>
                        </div>
                    </div>
    
                    <div class="py-2 d-flex align-items-center border-bottom">
                        <div div class="w-25">
                            <p class="font-weight-bold">Cellulare:</p>
                        </div>
                        <div>
                            <span class="ml-3">{{$user->phone_n}}</span>
                        </div>
                    </div>
    
                    <div class="py-2 d-flex align-items-center border-bottom">
                        <div div class="w-25">
                            <p class="font-weight-bold">Indirizzo:</p>
                        </div>
                        <div>
                            <span class="ml-3">{{$user->address}}</span>
                        </div>
                    </div>
                </div>
                

                <a class="d-block d-lg-none mt-3" href="{{route("admin.user.edit",Auth::id())}}"><button class="btn btn-primary">Modifica Profilo</button></a>
            </div>
        </div>

        {{----------------------------------- FORM MODIFICA PROFILO -----------------------------------}}
        <div class="d-none d-lg-block col-12 col-md-7">
            <div class="ms_card p-2">
                <h1>Modifica il tuo profilo</h1>
                <form action="{{route ("admin.user.update" , auth()->user() )}}" method="POST" enctype="multipart/form-data" role="form">
        
                    @method('PUT')
                    @csrf

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="name" class="form-label">Aggiungi Nome</label>
                                <input type="text"  name="name" value="{{ old('name') ?? $user->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Inserisci il tuo nome"/>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                        </div>
                
                        <div class="form-group col-md-6">
                            <label for="surname" class="form-label">Aggiungi Cognome</label>
                                <input type="text"  name="surname" value="{{ old('surname') ?? $user->surname }}" class="form-control @error('surname') is-invalid @enderror" placeholder="Inserisci il tuo cognome"/>
                                @error('surname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>

                    </div>
                    
                    
                    <div class="form-group ">
                        <label for="date" class="form-label">Aggiungi Data di nascita</label>
                        <input type="date" id="start" name="birth_date" value="{{old('date') ?? $user->birth_date}}">
                            @error('date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="address" class="form-label">Aggiungi Via</label>
                                <input type="text"  name="address" value="{{ old('address') ?? $user->address }}" class="form-control @error('address') is-invalid @enderror" placeholder="Inserisci la tua via"/>
                                @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                
                        <div class="form-group col-md-6">
                            <label for="phone_n" class="form-label">Aggiungi Numero di telefono</label>
                                <input type="text"  name="phone_n" value="{{ old('phone_n') ?? $user->phone_n }}" class="form-control @error('phone_n') is-invalid @enderror" placeholder="Inserisci il tuo numero"/>
                                @error('phone_n')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Modifica email</label>
                            <input type="text"  name="email" value="{{ old('email') ?? $user->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="Inserisci la tua email"/>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="image">Modifica l'immagine del tuo profilo</label>
                            <input type="file" name="image" class="@error('image') is-invalid @enderror form-control-file" id="image">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cv">Aggiungi il tuo cv</label>
                        <textarea name="cv" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Inserisci il tuo cv" class="form-control bcontent">{{ old('cv') ?? $user->cv }}</textarea>
                        @error('cv')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <h4>Titoli</h4>
                    <div class="ms_boxinput d-flex">
                        @foreach ($titles as $title)
                        <div class="form-check mx-1">
                            <input class="ms_checkbox form-check-input" type="checkbox" value="{{$title->id}}" 
                            name="titles[]" id="{{$title->id}}"
                            {{$user->titles->contains($title) ? "checked" : ""}}>
                            <label class="form-check-label" for="{{$title->id}}">
                                {{$title->name}}
                            </label>
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    @endforeach
                    </div>
                    

                    <h4>Performance</h4>
                    <div class="ms_boxinput d-flex">
                        @foreach ($performances as $performance)
                        <div class="form-check mx-1">
                            <input class="ms_checkbox form-check-input" type="checkbox" value="{{$performance->id}}" 
                            name="performances[]" id="{{$performance->id}}"
                            {{$user->performances->contains($performance) ? "checked" : ""}}>
                            <label class="form-check-label" for="{{$performance->id}}">
                                {{$performance->name}}
                            </label>
                            @error('performance')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    @endforeach
                    </div>
                    
            
                    <div class="form-group">
                        <input type="submit" name="Submit" value="Modifica" class="ms_button text-white  form-control" />
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
@endsection
