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

    public function delete($id)
    {
//        $character = \App\Character::where("id", $id)->first();
        $character = \App\Character::find($id);
        if ($character->combat) {
            $character->combat->delete();
        }
        $character->delete();

        return \Redirect::to('characters');
    }

    public function editCharacter(Request $request)
    {
        $id=$request->id;
        $character = \App\Character::find($id);
        $character->fill($request->all());
        $character->save();
        return \Redirect::to('characters');
    }
}
