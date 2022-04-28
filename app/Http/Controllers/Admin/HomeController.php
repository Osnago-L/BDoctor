<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Title;
use App\Performance;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;




class HomeController extends Controller
{   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $user = Auth::user();
        $user->load('titles');
        /* $user = User::with('titles')->get(); */
        /* dd($user); */
        $titles = Title::all();
        $performances = Performance::all();

        /* $titlesingola = Title::where();  */
        
        /* $titlesingola = $user->titles;*/

        /* dd($titlesingola); */
        

        /* dd($user); */
        
        

        return view('admin.home',compact('user', 'titles','performances'));
    }
}
