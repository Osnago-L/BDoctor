@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
       <div class="col-12">
            @if ($user->img)
               <img src="{{$user->img}}" alt="">
            @else
               <span>nessuna immagine :(</span>       
            @endif
            <div>{{$user->name,$user->surname}}</div>
            <div class="">
                @foreach($user->titles as $title)
                    {{$title->name}}
                @endforeach
            </div>
            <div>{{$user->email}}</div>
            <div>{{$user->address}}</div>
            @if ($user->phone_n)
                <div>{{$user->phone_n}}</div>
            @endif
            @if ($user->birth_date)
                <div>{{$user->birth_date}}</div>
            @endif
            @if ($user->cv)
                <div>{{$user->cv}}</div>
            @endif
       </div>
       <a class="mt-3" href="{{route("admin.user.edit",Auth::id())}}"><button class="btn btn-primary">Modifica Profilo</button></a>

    </div>
</div>
@endsection
