<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/combat', function () {
//  return view('combat');
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('characters', 'CharacterController@index');

Route::get('combat', 'CombatController@index');

Route::get('combat/generate/{lowCr}/{highCr}', 'CombatController@generateCombat');

Route::get('combat/nexturn', 'CombatController@nextTurn');

Route::get('combat/{id}', 'CombatController@getName');

Route::get('combat/delete/{id}', 'CombatController@delete');

Route::post('combat/add/create', 'CombatController@createAndAdd');

Route::post('combat/add/existing', 'CombatController@addExisting');

Route::post('combat/add/generate', 'CombatController@addGenerated');

Route::get('combat/maketurn/{id}', 'CombatController@makeTurn');


Route::post('combat/editroll/{id}', 'CombatController@editRoll');

Route::get('characters/monster/{monsterName}', 'CharacterController@getMonsterData');

Route::post('combat/takedamage/{id}', 'CombatController@takeDamage');

Route::post('characters/createcharacter', 'CharacterController@createCharacter');

Route::get('character/delete/{id}', 'CharacterController@delete');

