<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $guarded = ['roll'];

    public static function getMonsterData($monsterName)
    {
        return Monster::where('name', strtolower($monsterName))->first();
    }

    public function combat()
    {
        return $this->hasOne('App\Combat');
    }
}
