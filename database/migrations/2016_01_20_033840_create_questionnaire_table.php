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
            $t->string('the_knowledge_that_students_applied_to_work_done')->nullable();
            $t->string('reasons_to_study')->nullable();
            $t->string('the_reason_is_that_no_jobs')->nullable();
            $t->string('work_directly_with_the_subject_matter')->nullable();
            $t->string('issues_in_education')->nullable();
            $t->string('field_of_study')->nullable();
            $t->string('to_study_or_not')->nullable();
            $t->string('talent_helps_to_work')->nullable();
            $t->string('time_to_get_the_job_done')->nullable();
            $t->string('difficulties_in_finding_jobs')->nullable();
            $t->string('agencies')->nullable();
            $t->string('satisfaction_with_the_work_done')->nullable();
            $t->string('functional_status')->nullable();
            $t->string('position')->nullable();
            $t->string('category')->nullable();
            $t->string('types_of_work')->nullable();
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
