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
            $t->string('year_of_graduation');
            $t->string('national_id');
            $t->string('student_id');
            $t->string('title');
            $t->string('firstname');
            $t->string('lastname');
            $t->date('birthdate');
            $t->string('gpa');
            $t->string('house_no');
            $t->string('moo');
            $t->string('soi');
            $t->string('road');
            $t->string('district');
            $t->string('amphur');
            $t->string('province');
            $t->string('phone');
            $t->string('zipcode');
            $t->string('email');
            $t->string('education');
            $t->string('faculty');
            $t->string('branch');
            $t->string('course');
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
