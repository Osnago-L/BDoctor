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
                            <p class="ml-3">{{date_format($message->created_at, "d/m/Y H:i")}}</p>
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
                                        <button  type="submit" class="btn custom btn-danger  " data-toggle="modal" data-target="#exampleModal">
                                            Cancella
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
{{-- 
                            <form action="{{route("admin.messages.destroy", [Auth::user()->id, $message->id])}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger text-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr> --}}
                    @endforeach
                
                {{-- </tbody> --}}
            </table>
            @else
                <div>Non ci sono messaggi!</div>
            @endif
        </div>
    </div>

    


@endsection