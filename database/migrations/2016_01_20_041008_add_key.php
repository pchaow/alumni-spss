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
//        Schema::table('alumni', function (Blueprint $t) {
//            $t->integer('questionnaire_id')->unsigned();
//            $t->foreign('questionnaire_id')->references('id')->on('questionnaire');
//        });
//
//        Schema::table('workplace', function (Blueprint $t) {
//            $t->integer('alumni_id')->unsigned();
//            $t->foreign('alumni_id')->references('id')->on('alumni');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('alumni', function (Blueprint $t) {
//            $t->dropColumn('questionnaire_id')->unsigned();
//            $t->dropForeign('questionnaire_id')->references('id')->on('questionnaire');
//        });
//
//        Schema::table('workplace', function (Blueprint $t) {
//            $t->dropColumn('alumni_id')->unsigned();
//            $t->dropForeign('alumni_id')->references('id')->on('alumni');
//        });
    }
}
