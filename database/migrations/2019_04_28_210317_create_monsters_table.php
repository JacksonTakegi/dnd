<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonstersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monsters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("index");
            $table->string("url");
            $table->string("name");
            $table->string("size");
            $table->string("type");
            $table->string("subtype");
            $table->string("alignment");
            $table->integer("armor_class");
            $table->integer("hit_points");
            $table->string("hit_dice");
            $table->string("speed");
            $table->integer("strength");
            $table->integer("dexterity");
            $table->integer("constitution");
            $table->integer("intelligence");
            $table->integer("wisdom");
            $table->integer("charisma");
            $table->integer("medicine")->nullable();
            $table->integer("religion")->nullable();
            $table->integer("stealth")->nullable();
            $table->integer("persuasion")->nullable();
            $table->integer("insight")->nullable();
            $table->integer("deception")->nullable();
            $table->integer("arcana")->nullable();
            $table->integer("athletics")->nullable();
            $table->integer("acrobatics")->nullable();
            $table->integer("survival")->nullable();
            $table->integer("investigation")->nullable();
            $table->integer("nature")->nullable();
            $table->integer("intimidation")->nullable();
            $table->integer("performance")->nullable();

            $table->integer("constitution_save")->nullable();
            $table->integer("intelligence_save")->nullable();
            $table->integer("strength_save")->nullable();

            $table->integer("wisdom_save")->nullable();
            $table->integer("dexterity_save")->nullable();
            $table->integer("charisma_save")->nullable();

            $table->integer("history")->nullable();
            $table->integer("perception")->nullable();
            $table->string("damage_vulnerabilities");
            $table->string("damage_resistances");
            $table->string("damage_immunities");
            $table->string("condition_immunities");
            $table->string("senses");
            $table->string("languages");
            $table->float("challenge_rating");
            $table->json("reactions")->nullable();   

            $table->json("special_abilities")->nullable();
            $table->json("actions")->nullable();
            $table->json("legendary_actions")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monsters');
    }
}
