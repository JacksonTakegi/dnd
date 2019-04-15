<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CombatTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
    	$this->post('/combat/add', ['character' => 'test name', 'roll' => 10]);
    	$this->assertDatabaseHas('users', ['name' => 'test name', 'roll' => 10]);
    }
}
