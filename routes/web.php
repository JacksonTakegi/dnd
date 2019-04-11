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
// 	return view('combat');
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('combat', 'CombatController@index');

Route::get('combat/nexturn', 'CombatController@nextTurn');

Route::get('combat/{name}', 'CombatController@getName');

Route::get('combat/delete/{id}', 'CombatController@delete');

Route::post('combat/add', 'CombatController@addName');

Route::get('combat/maketurn/{id}', 'CombatController@makeTurn');

Route::post('combat/editroll/{id}', 'CombatController@editRoll');

