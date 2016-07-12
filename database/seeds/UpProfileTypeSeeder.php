<?php

use Illuminate\Database\Seeder;

class UpProfileTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $teacher = new \App\Models\Social\UpProfileType();
        $teacher->key = "teacher";
        $teacher->role = "Teacher";
        $teacher->save();

        $student = new \App\Models\Social\UpProfileType();
        $student->key = "student";
        $student->role = "Student";
        $student->save();
    }
}
