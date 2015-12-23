<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('users')->delete();
        DB::table('usertypes')->delete();

        $adminType = new \App\Models\UserType();
        $adminType->name="ADMIN";
        $adminType->description = "Admin Type";

        $alumniType = new \App\Models\UserType();
        $alumniType->name = "ALUMNI";
        $alumniType->description = "Alumni User Type";

        $adminType->save();
        $alumniType->save();

        $adminUser = new \App\Models\User();

        $adminUser->username = "admin";
        $adminUser->password = bcrypt('admin');
        $adminUser->national_id = "0000000000000";
        $adminUser->birthdate = \Carbon\Carbon::createFromDate(2000,1,1)->toDateString();
        $adminUser->email = "admin@admin.com";
        $adminUser->firstname = "ชลติพันธ์";
        $adminUser->lastname = "เปล่งวิทยา";

        $adminType->users()->save($adminUser);

        Model::reguard();
    }
}
