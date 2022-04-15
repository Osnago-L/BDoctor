@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="ms_box col-lg-12 col-md-6  col-sm-6 ">
            <h1>Benvenuto {{$user->name}}</h1>
            <p>{{$user->surname}}</p>
            <p>{{$user->address}}</p>
            <p>{{$user->phone_n}}</p>
            <p>{{$user->email}}</p>
        </div>
    </div>
    
    
</div>
@endsection
