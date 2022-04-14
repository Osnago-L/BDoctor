<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Title;
use App\Performance;
use App\User;

class UserEditController extends Controller
{
    public function edit(User $user)
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
        /* dd($request); */
        $request->validate( [
            'name' => 'required|string|max:20',
            'surname' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'address' => 'required|string|max:50',
            /* 'title_id' => 'required|exists:titles,id', */
            /* 'performance_id' => 'array|exists:performance,id', */
            'image' => 'nullable|image|mimes:jpg,bmp,png,jpeg,svg',
            'cv' => 'nullable|string',
            'phone_n' => 'nullable|string'
        ]);

        
        $form_data = $request->all();

        /* if(isset($form_data["image"])){
            $img_path = Storage::put('uploads', $form_data['image']);
            $datoValidato['image'] = $img_path;
        } */
        

        $user->update($form_data);

        
        /* $user->performances()->sync(isset($form_data['performance_id']) ? $form_data['performance_id'] : []); */

        return redirect()->route('admin.user.index');
    }
}
