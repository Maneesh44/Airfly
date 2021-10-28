<?php

namespace App;
use App\Flight;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];
    
    public function credit(){
    	return $this->hasOne('App\Credit');
    }

}
