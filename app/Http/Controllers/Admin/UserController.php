<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Title;
use App\Performance;
use App\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use DateTime;
use Illuminate\Support\Facades\Storage;


use App\User;

class UserController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        /* $sponsorship = Sponsorship::All(); */
        $user->load('sponsorships');

        $now = Carbon::now()->format('d-m-Y H:i:s');


        foreach ($user->sponsorships as $sponsor){
            
            $sponsor->pivot->expiration = DateTime::createFromFormat('Y-m-d H:i:s', $sponsor->pivot->expiration)->format('d-m-Y H:i:s'); 
            /* $sorted = collect($sponsor->pivot->expiration)->sortByDesc('expiration'); */
        }; 
        
        /* dd($user); */
        /* $sort = DB::table('sponsorship_user')
        ->where('user_id' , $user)
        ->orderBy('expiration','asc')->get();
        dump($sort); */
        

        return view('admin.users.index',compact('user' ,'now' ));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
     //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        
        $titles = Title::all();
        $performances = Performance::all();
        return view('admin.users.edit', compact('user', 'titles','performances'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {   
        $request->validate( [
            'name' => 'required|string|max:20',
            'surname' => 'required|string|max:20',
            'email' => "required|string|email|max:255|unique:users,email,{$user->id}",
            'address' => 'required|string|max:50',
            'titles' => 'array|required|exists:titles,id', 
            'performances' => 'array|exists:performances,id',  
            'image' => 'nullable|image|mimes:jpg,bmp,png,jpeg,svg',
            'cv' => 'nullable|string',
            'phone_n' => 'nullable|string'
        ]);

        $form_data = $request->all();

        if(isset($form_data["image"])){
            $img_path = Storage::put('uploads', $form_data['image']);
            $form_data['image'] = $img_path;
        }
        
        $user->titles()->sync(isset($form_data['titles']) ? $form_data['titles'] : []);
        $user->performances()->sync(isset($form_data['performances']) ? $form_data['performances'] : []);

        $user->update($form_data);

        /* Flash::success('Profile updated successfully.'); */

        return redirect()->route('admin.user.index')->with('message', 'Profilo modificato!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        //
    }

}
