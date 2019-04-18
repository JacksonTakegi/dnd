<?php

namespace App\Http\Controllers;

use App\Character;
use GuzzleHttp\Client;

class CharacterController extends Controller
{
    public function index()
    {
        $characters = Character::orderByRaw("FIELD(character_type, 'pc', 'inpc', 'npc') ASC")->get();
        return \View::make('characters', array('characters' => $characters));
    }

    public function getMonsterData($monsterName)
    {
        return Character::getMonsterData($monsterName);
    }
}
