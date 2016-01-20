<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionnaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaire',function(Blueprint $t){
            $t->increments('id');
            $t->string('the_knowledge_that_students_applied_to_work_done');
            $t->string('reasons_to_study');
            $t->string('the_reason_is_that_no_jobs');
            $t->string('work_directly_with_the_subject_matter');
            $t->string('issues_in_education');
            $t->string('field_of_study');
            $t->string('to_study_or_not');
            $t->string('talent_helps_to_work');
            $t->string('time_to_get_the_job_done');
            $t->string('difficulties_in_finding_jobs');
            $t->string('agencies');
            $t->string('satisfaction_with_the_work_done');
            $t->string('functional_status');
            $t->string('position');
            $t->string('category');
            $t->string('types_of_Work');
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
        Schema::drop('questionnaire');
    }
}
