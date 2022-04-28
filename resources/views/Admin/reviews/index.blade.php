@extends('layouts.app')


@section('title', 'Recensioni su {{$user->name}}')


@section('content')

@php   
    $sum = 0;
    foreach($reviews as $review){
        $sum += $review->score;
    }

    if(count($reviews) > 0 ){
        $avgScore = round($sum / count($reviews), 1);


        $integers = (int) $avgScore;
        $decimals = round($avgScore - $integers);
        $avgStars = "";

        for($i = 0; $i < $integers; $i++){
            $avgStars .= "<i class='ms_star fa-solid fa-star'></i>";
        }
        if ($decimals >= 0.5){
            $avgStars .= "<i class='ms_star fa-solid fa-star-half-stroke'></i>";
        }
        for($i = ceil($avgScore); $i < 5; $i++){
            $avgStars .= "<i class='ms_star fa-regular fa-star'></i>";
        }
    }

@endphp

<div class="container py-5">

    <h2>Recensioni ricevute ({{count($reviews) }})</h2>


    @if(count($reviews) > 0 )
        <h5>Media recensioni: {!!$avgStars!!} <strong>{{$avgScore}} / 5</strong></h5>
    <hr class='mb-5'>

    @foreach($reviews as $review)
        
        <div class="ms_card my-2 p-1">
    
            <div class="review-header p-2">

                <div class="asd row align-items-center justify-content-between">

                    <div class="col-auto">
                        <h3>{{$review->title}}</h3>
                    </div>
                    
                    <div class="col">
                        
                        <span>
                            @for ($i = 0; $i < $review->score; $i++)
                            <i class='ms_star fa-solid fa-star'></i>
                            @endfor
                            @for ($i = $review->score; $i < 5; $i++)
                            <i class='ms_star fa-regular fa-star'></i>
                            @endfor
                        </span>
                        
                        @php 
                        $dateTime = new DateTime($review->created_at);
                        $date = $dateTime->format('d/m/Y');
                        $time = $dateTime->format("H:i");
                        @endphp
                    </div>
                </div>

                <div class="row">
                    <div class="col align-items-center justify-content-between my-2">
                        <span class='ms_user h5'><i class="fa-solid fa-user"></i> {{$review->author}} </span>
                        <span class='ms_datetime ml-2'><i class="fa-solid fa-clock"></i> {{$date}} - {{$time}}</span>
                    </div>
                </div>
            </div>

            <div class="review-body p-3">
                <p>{{$review->content}}</p>
            </div>

        </div>
    @endforeach
    @endif
</div>
    
    

@endsection