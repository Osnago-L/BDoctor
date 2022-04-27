@extends('layouts.app')

@section('content')

<div class="container">
    
    <form action="{{route ("admin.user.update" , auth()->user() )}}" method="POST" enctype="multipart/form-data" role="form">
        
        @method('PUT')
        @csrf


        
        <div class="form-group">
            <label for="name" class="form-label">Aggiungi Nome</label>
                <input type="text"  name="name" value="{{ old('name') ?? $user->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Inserisci il tuo nome"/>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        </div>

        <div class="form-group">
            <label for="surname" class="form-label">Aggiungi Cognome</label>
                <input type="text"  name="surname" value="{{ old('surname') ?? $user->surname }}" class="form-control @error('surname') is-invalid @enderror" placeholder="Inserisci il tuo cognome"/>
                @error('surname')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        </div>

        <div class="form-group">
            <label for="date" class="form-label">Aggiungi Data di nascita</label>
            <input type="date" id="start" name="birth_date" value="{{old('date') ?? $user->birth_date}}">
                @error('date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        </div>

        <div class="form-group">
            <label for="address" class="form-label">Aggiungi Via</label>
                <input type="text"  name="address" value="{{ old('address') ?? $user->address }}" class="form-control @error('address') is-invalid @enderror" placeholder="Inserisci la tua via"/>
                @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        </div>

        <div class="form-group">
            <label for="phone_n" class="form-label">Aggiungi Numero di telefono</label>
                <input type="text"  name="phone_n" value="{{ old('phone_n') ?? $user->phone_n }}" class="form-control @error('phone_n') is-invalid @enderror" placeholder="Inserisci il tuo numero"/>
                @error('phone_n')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

        </div>

        <div class="form-group">
            <label for="cv">Aggiungi il tuo cv</label>
            <textarea name="cv" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Inserisci il tuo cv" class="form-control bcontent">{{ old('cv') ?? $user->cv }}</textarea>
            @error('cv')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <H1>Titolo</H1>
        @foreach ($titles as $title)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{$title->id}}" 
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
        <H1>performance</H1>
        @foreach ($performances as $performance)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{$performance->id}}" 
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

        

        <div class="form-group">
            <label for="email">Modifica email</label>
            <input type="text"  name="email" value="{{ old('email') ?? $user->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="Inserisci la tua email"/>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="image">Modifica l'immagine del tuo profilo</label>
            <input type="file" name="image" class="@error('image') is-invalid @enderror form-control-file" id="image">
        </div>

        <div class="form-group">
            <input type="submit" name="Submit" value="Modifica" class="ms_buttonblue btn btn-primary form-control" />
        </div>
    </form>

</div>
@endsection
