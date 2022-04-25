@extends('layouts.app')


@section('title', 'Messaggio da {{$message->author}}')


@section('content')


<div class="container message py-5">

    
    <div class="ms_cardmessage  mb-2">
            
        <div class="ms_info p-3 d-flex align-items-center justify-content-between">
            
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-user px-2"></i>
                <h3 class="m-0">{{$message->author}}</h3>
            </div>
            
            <div class="d-flex align-items-center ms_datetime">
                <i class="fa-solid fa-clock"></i>
                <p> {{$date}} - {{$time}}</p>
            </div>

        </div>
        
        <div class="ms_text p-4">
            {{$message->content}}
        </div>
        
        <div>
            <a href="mailto:{{$message->email}}?subject=RE: {{config('app.name')}} - messaggio di {{$message->author}} del {{$message->created_at}} ">
                <button class='btn btn-primary w-100'>
                    <i class="fa-solid fa-message"></i> Rispondi
                </button>
            </a>
            
        </div>
    </div>

    



    
</div>

@endsection