<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBookedSeats extends Model
{
    protected $guarded =[];

    public function bus(){
        return $this->belongsTo('App\Bus');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
