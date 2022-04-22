<?php

namespace App\Http\Controllers\Api;

use App\Review;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        
        $validator= Validator::make($data, [
            'author' => 'nullable | string',
            'title' => 'nullable | string',
            'content' => 'nullable | string',
            'score' => 'required | numeric | between: 1, 5',
            'user_id' => 'exists: users, id'
        ]);

        $nuovoRecensione = new Review();

        $nuovoRecensione->fill($data);
        $nuovoRecensione->save();

        return response()->json([
            "success" => true,
            'data' => $nuovoRecensione,
        ]);
    }
}
