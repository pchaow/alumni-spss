<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni',function(Blueprint $t){
            $t->increments('id');
            $t->string('university');
            $t->string('faculty');
            $t->string('branch');
            $t->string('name_title');
            $t->string('firstname');
            $t->string('lastname');
            $t->timestamps();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alumni');

    }
}
