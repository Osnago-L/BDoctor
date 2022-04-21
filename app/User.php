<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','surname', 'email', 'password', 'address','birth_date','cv','image','phone_n','title_id','performance_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function message(){
        return $this->hasMany('App\Message');
    }
    public function reviews(){
        return $this->hasMany('App\Review');
    }
    public function titles(){
        return $this->belongsToMany('App\Title');
    }
    public function performances(){
        return $this->belongsToMany('App\Performance');
    }
    public function sponsorships(){
        return $this->belongsToMany('App\Sponsorship')->withPivot('start_date', 'expiration');
    }
}

