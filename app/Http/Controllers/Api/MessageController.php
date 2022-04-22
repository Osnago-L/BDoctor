<?php

namespace App\Http\Controllers\Api;

use App\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        
        $validator= Validator::make($data, [
            'author' => 'required | string',
            'email' => 'required | email',
            'content' => 'required | string',
            'user_id' => 'exists: users, id'
        ]);

        $nuovoMessaggio = new Message();

        $nuovoMessaggio->fill($data);
        $nuovoMessaggio->save();

        return response()->json([
            "success" => true,
            'data' => $nuovoMessaggio,
        ]);
    }
}
