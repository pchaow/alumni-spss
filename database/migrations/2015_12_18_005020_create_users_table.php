<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usertypes',function(Blueprint $t){
            $t->increments('id');
            $t->string('name')->unique();
            $t->text('description');
            $t->timestamps();
        });


        Schema::create('users',function(Blueprint $t){
            $t->increments('id');
            $t->string('username')->unique();
            $t->string('password')->nullable()	;
            $t->string('national_id')->unique();
            $t->date('birthdate');
            $t->string('firstname');
            $t->string('lastname');
            $t->string('email')->nullable();

            $t->timestamps();

            $t->integer('usertype_id')->unsigned();
            $t->foreign('usertype_id')->references('id')->on('usertypes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
        Schema::drop('usertypes');
    }
}
