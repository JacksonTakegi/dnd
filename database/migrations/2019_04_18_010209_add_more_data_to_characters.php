<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreDataToCharacters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->integer('ac')->default(0);
            $table->string('player')->nullable();
            $table->string('class')->nullable();
            $table->integer('level')->default(0);
            $table->string('race')->nullable();
            $table->integer('str')->default(0);
            $table->integer('dex')->default(0);
            $table->integer('con')->default(0);
            $table->integer('int')->default(0);
            $table->integer('wis')->default(0);
            $table->integer('cha')->default(0);
            $table->string('api')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropColumn('ac');
            $table->dropColumn('player');
            $table->dropColumn('class');
            $table->dropColumn('level');
            $table->dropColumn('race');
            $table->dropColumn('str');
            $table->dropColumn('dex');
            $table->dropColumn('con');
            $table->dropColumn('int');
            $table->dropColumn('wis');
            $table->dropColumn('cha');
        });
    }
}
