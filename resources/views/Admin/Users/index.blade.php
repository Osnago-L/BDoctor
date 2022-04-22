@extends('layouts.app')

@section('content')
<div class="container vh-100">
    <div class="row">
       <div class="col-12">
            @if ($user->image)
               <img style="width:300px" src="{{asset('storage/' . $user->image)}}" alt="">
            @else
               <span>nessuna immagine :(</span>       
            @endif
            <div>{{$user->name,$user->surname}}</div>
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
            <h1>TITULI</h1>
            <div>
                @foreach($user->titles as $title)
                <h6><span class="badge badge-secondary">{{$title->name ? $title->name : '-'}}</span></h6>
                @endforeach
            </div>
            <h1>PRESTAZIONI</h1>
            <div>
                @foreach($user->performances as $performance)
                <h6><span class="badge badge-danger">{{$performance->name ? $performance->name : '-'}}</span></h6>
                @endforeach
            </div>
       </div>
       <a class="mt-3" href="{{route("admin.user.edit",Auth::id())}}"><button class="btn btn-primary">Modifica Profilo</button></a>

    </div>
</div>
@endsection
