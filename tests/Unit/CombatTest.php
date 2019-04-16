<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \App\User;

class CombatTest extends TestCase
{
    // use RefreshDatabase;

    // /** @test */
    // public function testAddCharacter()
    // {
    // 	$this->post('/combat/add', ['character' => 'test name', 'roll' => 10]);
    // 	$this->assertDatabaseHas('users', ['name' => 'test name', 'roll' => 10]);
    // }

    // /** @test */
    // public function testDeleteCharacter()
    // {
    //     $user = new User;
    //     $user->name = "aaaa";
    //     $user->roll = 10;
    //     $user->turn = false;
    //     $user->save();

    //     $this->get('/combat/delete/'. $user->id);
    //     $this->assertDatabaseMissing('users',['id' => $user->id]);
    // }

}
