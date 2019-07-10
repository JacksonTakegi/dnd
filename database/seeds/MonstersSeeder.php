<?php

use Illuminate\Database\Seeder;
use App\Monster;
class MonstersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Monster::truncate();
        $monstersFile = Storage::get('5e-SRD-Monsters.json');
        $monstersJson =json_decode($monstersFile);
        echo(count($monstersJson) . " monsters found");
        foreach ($monstersJson as $monster) {
        	foreach ($monster as $key => $value) {
        		if (gettype($value) == "object" || gettype($value) == "array" ) {
        			$monster->$key = json_encode($value);
        		}
        	}
        	$newMonster = Monster::create( (array)$monster );
        }

    }
}
