<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use Illuminate\Auth\Events\Validated;

use DateTime;


class MessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Message $message)
    {   
        $user = Auth::user();
        $messages = Message::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

        $dateTime = new DateTime($message->created_at);
        $date = $dateTime->format('d/m/Y');
        $time = $dateTime->format("H:i");

        if (!$message){
            abort(404);
        }

        return view('admin.messages.index', compact('user','messages','date','time'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user,Message $message)
    {
        
        $dateTime = new DateTime($message->created_at);
        
        $date = $dateTime->format('d/m/Y');
        $time = $dateTime->format("H");


        if (!$message){
            abort(404);
        }

        return view('admin.messages.show', compact('message','date','time'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Message dependency injection with passed id of message
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,Message $message)
    {   
        
        $message->delete();

        return redirect()->route('admin.messages.index', Auth::id())->with('success','Messaggio Cancellato');
    }
}
