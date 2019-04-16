<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combat extends Model
{
    public function character()
    {
        return $this->belongsTo('App\Character');
    }
}
