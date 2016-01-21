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
            $t->string('year_of_graduation')->nullable();
            $t->string('national_id')->nullable();
            $t->string('student_id')->nullable();
            $t->string('title')->nullable();
            $t->string('firstname')->nullable();
            $t->string('lastname')->nullable();
            $t->date('birthdate')->nullable();
            $t->string('gpa')->nullable();
            $t->string('house_no')->nullable();
            $t->string('moo')->nullable();
            $t->string('soi')->nullable();
            $t->string('road')->nullable();
            $t->string('district')->nullable();
            $t->string('amphur')->nullable();
            $t->string('province')->nullable();
            $t->string('phone')->nullable();
            $t->string('zipcode')->nullable();
            $t->string('email')->nullable();
            $t->string('education')->nullable();
            $t->string('faculty')->nullable();
            $t->string('branch')->nullable();
            $t->string('course')->nullable();
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
