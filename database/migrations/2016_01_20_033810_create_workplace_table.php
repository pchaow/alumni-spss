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
            $t->string('office')->nullable();
            $t->string('number_office')->nullable();
            $t->string('moo_office')->nullable();
            $t->string('building_office')->nullable();
            $t->string('class_office')->nullable();
            $t->string('soi_office')->nullable();
            $t->string('road_office')->nullable();
            $t->string('amphur_office')->nullable();
            $t->string('district_office')->nullable();
            $t->string('province_office')->nullable();
            $t->string('zipcode_office')->nullable();
            $t->string('phone_office')->nullable();
            $t->string('fax_office')->nullable();
            $t->string('email_office')->nullable();
            $t->string('salary')->nullable();
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
