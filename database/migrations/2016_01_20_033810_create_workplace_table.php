<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkplaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workplace',function(Blueprint $t){
            $t->increments('id');
            $t->string('office');
            $t->string('number_office');
            $t->string('swine_office');
            $t->string('building_office');
            $t->string('class_office');
            $t->string('alley_office');
            $t->string('road_office');
            $t->string('amphur_office');
            $t->string('district_office');
            $t->string('province_office');
            $t->string('zipcode_office');
            $t->string('phone_office');
            $t->string('fax_office');
            $t->string('email_office');
            $t->string('salary');
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
        Schema::drop('workplace');

    }
}
