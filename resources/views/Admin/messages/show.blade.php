@extends('layouts.app')


@section('title', 'Messaggio da {{$message->author}}')


@section('content')


<div class="container message g-2">

    
    <div class="message-header row rounded-box mb-2">
            
        <div class="info">

            <h3>{{$message->author}}</h3>

            @php
                $dateTime = new DateTime($message->created_at);
                $date = $dateTime->format('d/m/Y');
                $time = $dateTime->format("H:i");
            @endphp

            <span><i class="fa-solid fa-clock"></i> {{$date}} - {{$time}}</span>
        </div>
    </div>

    <div class="message-body row rounded-box mb-3">
    
            <p>{{$message->content}}</p>
    </div>



    <div class="row">
        <a href="mailto:{{$message->email}}?subject=RE: {{config('app.name')}} - messaggio di {{$message->author}} del {{$message->created_at}} ">
            <button class='btn btn-primary'>
                <i class="fa-solid fa-message"></i> Rispondi
            </button>
        </a>
    </div>
</div>

@endsection