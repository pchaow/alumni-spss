<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThailandProvince extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(file_get_contents(resource_path("assets/database/thailand.sql")));

        // trim province
        DB::update(' update province set province_code = trim(province_code)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('amphur');
        Schema::drop('district');
        Schema::drop('province');
        Schema::drop('geography');
    }
}
