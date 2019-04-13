<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CombatController extends Controller
{
   public function index(){
    $users = \App\User::all()->sortByDesc("roll");
    return \View::make('combat', array('users' => $users));
    
   }

   public function getName($name){
    $user = \App\User::where("name", $name)->get();
    return $user;
   }

   public function addName(Request $request){
    $user = new \App\User();
    $user->name = $request->character;
    $user->roll = $request->roll;
    $user->turn = false;
    $user->save();
    return \Redirect::to('combat');
   }

   public function delete($id){
    $user = \App\User::where("id", $id)->first();
    $user->delete();
    return \Redirect::to('combat');
   }

   public function makeTurn($id){
    $user = \App\User::where("id", $id)->first();
    $user->turn = true;
    $user->save();
    $users = \App\User::where('id', "!=",$id)->get();
    foreach ($users as $user) {
        $user->turn = false;
        $user->save();
    }
    return \Redirect::to('combat');
   }

   public function nextTurn(){
    $turns=0;
    $users = \App\User::orderBy('roll', 'desc')->get();
    $nextUsersTurn = false;
    foreach ($users as $user) {

         if ($nextUsersTurn) {
            $user->turn = true;
            $nextUsersTurn = false;
            $user->save();
            return \Redirect::to('combat');
        }

        if ($user->turn ) {
            $user->turn = false;
            $user->save();
            $nextUsersTurn = true;
        }


    }
   $users[0]->turn = true;
   $users[0]->save();
   $turns++;
   // add one to the total turns
   return \Redirect::to('combat');
   }

   public function editRoll($id, Request $request){
    $user= \App\User::where("id", $id)->first();
    $user->roll=$request->roll;
    $user->save();
    return \Redirect::to('combat');
   }

}


/* 
DB TABLES

combat_stats
    name = turn_count
    value = 1

characters
    character_type = pc, npc, important npc
    name
    health
    other character sheet stuff
    status = alive, dead, anything else

combat

    user_id
    roll
    current turn
    etc

*/