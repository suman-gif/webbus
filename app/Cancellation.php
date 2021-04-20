<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cancellation extends Model
{

    public function bus(){
        return $this->belongsTo('App\Bus');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function report(){
        return $this->belongsTo('App\UserBookedSeats');
    }


}
