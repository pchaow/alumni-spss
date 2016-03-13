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
            $t->string('yearOfGraduation')->nullable();
            $t->string('personal_id')->nullable();
            $t->string('student_id')->nullable();
            $t->string('title')->nullable();
            $t->string('firstname')->nullable();
            $t->string('lastname')->nullable();
            $t->date('birthdate')->nullable();
            $t->string('gpa')->nullable();
            $t->string('houseNo')->nullable();
            $t->string('houseMo')->nullable();
            $t->string('houseSoi')->nullable();
            $t->string('houseRoad')->nullable();
            $t->string('houseDistrict')->nullable();
            $t->string('houseAmphur')->nullable();
            $t->string('houseProvince')->nullable();
            $t->string('telephone')->nullable();
            $t->string('houseZipno')->nullable();
            $t->string('email')->nullable();
            $t->string('degree')->nullable();
            $t->string('faculty')->nullable();
            $t->string('branch')->nullable();
            $t->string('course')->nullable();
            $t->string('plan')->nullable();
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
