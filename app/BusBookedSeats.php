<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusBookedSeats extends Model
{
    //
    protected $guarded =[];


    public function bus(){
        return $this->belongsTo('App\Bus');
    }
}
