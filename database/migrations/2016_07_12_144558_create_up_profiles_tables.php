<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpProfilesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('up_profile_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key')->unique();
            $table->string('role');
            $table->timestamps();
        });

        Schema::create('up_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('up_profile_type_id');
            $table->string('session_id')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('firstname')->unique();
            $table->string('lastname');
            $table->string('faculty');

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
        Schema::drop('up_profiles');
        Schema::drop('up_profile_types');
    }
}
