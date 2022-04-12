<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    public function users(){
        return $this->belongsToMany('App\User');
    }
}
