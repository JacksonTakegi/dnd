<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class combatTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCombatPageLoads()
    {
        $response = $this->get('/combat');
        $response->assertStatus(200);
    }
    
}
