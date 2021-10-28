<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }


    public function booking(){
    	return $this->hasOne('App\Booking');
    }
}
