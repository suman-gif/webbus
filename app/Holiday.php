<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
     public function bus(){
        return $this->belongsTo('App\Bus');
    }

    protected $guarded = [];
}
