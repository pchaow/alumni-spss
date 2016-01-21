<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questionnaire', function (Blueprint $t) {
            $t->integer('alumni_id')->nullable();
            //$t->foreign('alumni_id')->references('id')->on('alumni');
        });

        Schema::table('workplace', function (Blueprint $t) {
            $t->integer('alumni_id')->nullable();
           // $t->foreign('alumni_id')->references('id')->on('alumni');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questionnaire', function (Blueprint $t) {
            $t->dropColumn('alumni_id');
            //$t->dropForeign('alumni_id')->references('id')->on('alumni');
        });

        Schema::table('workplace', function (Blueprint $t) {
            $t->dropColumn('alumni_id');
           //$t->dropForeign('alumni_id')->references('id')->on('alumni');
        });
    }
}
