<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFacebookConnectToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function(Blueprint $t){
            $t->string('facebook_id')->nullable();
            $t->string('facebook_name')->nullable();
            $t->string('facebook_email')->nullable();
            $t->string('facebook_token')->nullable();
            $t->string('facebook_profile_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users',function(Blueprint $t){
            $t->dropColumn('facebook_id');
            $t->dropColumn('facebook_name');
            $t->dropColumn('facebook_email');
            $t->dropColumn('facebook_token');
            $t->dropColumn('facebook_profile_url');
        });
    }
}
