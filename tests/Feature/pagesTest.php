<?php

namespace Tests\Feature;

use Tests\TestCase;

class pagesTest extends TestCase
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

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomePageLoads()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCharacterPageLoads()
    {
        $response = $this->get('/characters');
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMonsterDataLoads()
    {
        $response = $this->get('/characters/monster/Goblin');
        $response->assertStatus(200);
    }

}
