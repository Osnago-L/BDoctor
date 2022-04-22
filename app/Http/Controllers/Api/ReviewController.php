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

        if( !empty( $data["author"]) ) {
            $nuovoRecensione->author = $data["author"];
        }else{
            $nuovoRecensione->author = "Anonimo";
        }

        if( !empty( $data["title"]) ) {
            $nuovoRecensione->title = $data["tile"];
        }else{
            $nuovoRecensione->title = "-";
        }

        if( !empty( $data["content"]) ) {
            $nuovoRecensione->content = $data["content"];
        }else{
            $nuovoRecensione->content = "-";
        }

        $nuovoRecensione->fill($data);
        $nuovoRecensione->save();

        return response()->json([
            "success" => true,
            'data' => $nuovoRecensione,
        ]);
    }
}
