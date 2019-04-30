<?php

namespace App\Http\Controllers;

use App\Character;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

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

    public function createCharacter(Request $request)
    {
        $requestData = array_filter($request->all());
        $character = new \App\Character($requestData);
        $character->current_health = $character->max_health ?? "1";
        $character->save();
        return \Redirect::to('characters');
    }
}
