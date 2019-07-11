<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToCombatsAndCharacters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('characters', function (Blueprint $table) {
             $table->integer('user_id');
        });
        Schema::table('combats', function (Blueprint $table) {
             $table->integer('user_id');
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
             $table->dropColumn('user_id');
        });
        Schema::table('combats', function (Blueprint $table) {
             $table->dropColumn('user_id');
        });
    }
}
