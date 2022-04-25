@extends('layouts.app')


@section('title', "Elenco messaggi")


@section('content')

    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>
                        Hai
                        ({{(count($messages) )}}) 
                        @if (count($messages) == 1)
                        messaggio
                        @else
                        messaggi
                        @endif  
                    </h1>
                </div>
            </div>
        
        <div class='col-12'>
            @if (count($messages) > 0 )
            
            <table>
                @foreach ($messages as $message)
                <div class="ms_cardmessage  my-4">
                    <div class="ms_info p-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-user px-2"></i>
                            <h3 class="m-0">{{$message->author}}</h3>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-clock"></i>
                            <p class="ml-3">{{$message->created_at}}</p>
                        </div>
                    </div>

                    <div class="ms_text p-4">
                        {{$message->content}}
                    </div>

                    <div class="ms_buttonbox d-flex ">

                        <a href="{{route("admin.messages.show", [Auth::user()->id, $message->id])}}">
                            <button type="button" class="btn btn_custom  text-white rounded-0">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </a>

                        <button  type="button" class="btn custom btn-danger  rounded-0" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>

                    </div>
                    
                    <!--------------------------------- Modal ------------------------------>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cancella</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Sicuro di voler cancellare questo messaggio?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Indietro</button>
                                    <form action="{{route("admin.messages.destroy", [Auth::user()->id, $message->id])}}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button  type="submit" class="btn custom btn-danger  rounded-0" data-toggle="modal" data-target="#exampleModal">
                                            Cancella
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 

                </div>
                @endforeach
            @else
                <div>Non ci sono messaggi!</div>
            @endif
        </div>
    </div>

    


@endsection