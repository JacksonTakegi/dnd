<?php

namespace App\Http\Controllers;

use App\Character;
use Illuminate\Http\Request;

class CombatController extends Controller
{
    public function index()
    {
        $combats = \App\Combat::all()->sortByDesc("roll");
        return \View::make('combat', ['combats' => $combats, 'monsterList'=>\App\Monster::listNames()]);
    }

    public function getName($id)
    {
        $combat = \App\Combat::where("id", $id)->first();
        return $combat->character->name;
    }

    public function fillDefaultMonsterValues($character, $race)
    {
        $monsterData = \App\Monster::where('name', $race)->first();
        $columns = \Schema::getColumnListing("characters");


        // Fill in all the main stuff
        $character->str = $monsterData->strength;
        $character->dex = $monsterData->dexterity;
        $character->con = $monsterData->constitution;
        $character->int = $monsterData->intelligence;
        $character->wis = $monsterData->wisdom;
        $character->cha = $monsterData->charisma;
        $character->ac = $monsterData->armor_class;
        $character->max_health = $monsterData->hit_points;
        $character->current_health = $monsterData->hit_points;

        // try to fill in any columns that are still blank
        foreach ($columns as $columnName) {
            if (!isset($character->$columnName) && isset($monsterData->$columnName)) {
                $character->$columnName = $monsterData->$columnName;
            }
        }
        return $character;
    }



    public function addName(Request $request)
    {
        // Remove blank values
        $character = \App\Character::where("name", $request->name)->first();
        $requestData = array_filter($request->all());


        // Create a new character if it doesn't already exist
        if ($character) {
        } else {
            $character = new \App\Character($requestData);
            $character->current_health = $character->max_health ?? "1";
            if ($request->api) {
                $character = $this->fillDefaultMonsterValues($character, $request['race']);
                $character->level = 1;
            }

            $character->save();
        }

        $combat = new \App\Combat();
        $combat->character_id = $character->id;
        $combat->roll = $request->roll;
        $combat->current_turn = false;
        $combat->save();
        return \Redirect::to('combat');
    }

    public function delete($id)
    {
        $combat = \App\Combat::where("id", $id)->first();
        $combat->delete();
        return \Redirect::to('combat');
    }

    public function makeTurn($id)
    {
        $combat = \App\Combat::where("id", $id)->first();
        $combat->current_turn = true;
        $combat->save();
        $combats = \App\Combat::where('id', "!=", $id)->get();
        foreach ($combats as $combat) {
            $combat->current_turn = false;
            $combat->save();
        }
        return \Redirect::to('combat');
    }

    public function nextTurn()
    {
        $combats = \App\Combat::orderBy('roll', 'desc')->get();
        $nextCombatsTurn = false;
        foreach ($combats as $combat) {
            if ($nextCombatsTurn) {
                $combat->current_turn = true;
                $nextCombatsTurn = false;
                $combat->save();
                return \Redirect::to('combat');
            }

            if ($combat->current_turn) {
                $combat->current_turn = false;
                $combat->save();
                $nextCombatsTurn = true;
            }
        }
        $combats[0]->current_turn = true;
        $combats[0]->save();
        // add one to the total turns
        return \Redirect::to('combat');
    }

    public function editRoll($id, Request $request)
    {
        $combat = \App\Combat::where("id", $id)->first();
        $combat->roll = $request->roll;
        $combat->save();
        return \Redirect::to('combat');
    }

    public function takeDamage($id, Request $request)
    {
        $combat = \App\Combat::where("id", $id)->first();
        $combat->character->current_health -= $request->damage;
        $combat->character->save();
        return \Redirect::to('combat');
    }
}
