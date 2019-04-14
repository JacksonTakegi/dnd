<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function saveRoll($roll)
    {
        $this->roll = $roll;
    }
}
