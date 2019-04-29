<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monster extends Model
{
	public static function listNames(){
		return Monster::all()->pluck('name');
	}
}
