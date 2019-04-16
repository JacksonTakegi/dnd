<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function index()
    {
        $characters = \App\Character::orderByRaw("FIELD(character_type, 'pc', 'inpc', 'npc') ASC")->get();
        return $characters;
    }
}
