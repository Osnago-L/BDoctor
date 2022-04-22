<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['author','title','content','score','user_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
