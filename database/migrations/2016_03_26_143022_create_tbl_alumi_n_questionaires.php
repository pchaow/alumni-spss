<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblAlumiNQuestionaires extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('alumni',function(Blueprint $t){
            $t->increments('id');
            $t->string('yearOfGraduation')->nullable();
            $t->string('personal_id')->nullable();
            $t->string('student_id')->nullable();
            $t->string('title')->nullable();
            $t->string('firstname')->nullable();
            $t->string('lastname')->nullable();
            $t->date('birthdate')->nullable();
            $t->string('gpa')->nullable();
            $t->string('houseNo')->nullable();
            $t->string('houseMo')->nullable();
            $t->string('houseSoi')->nullable();
            $t->string('houseRoad')->nullable();
            $t->string('houseDistrict')->nullable();
            $t->string('houseAmphur')->nullable();
            $t->string('houseProvince')->nullable();
            $t->string('telephone')->nullable();
            $t->string('houseZipno')->nullable();
            $t->string('email')->nullable();
            $t->string('degree')->nullable();
            $t->string('faculty')->nullable();
            $t->string('branch')->nullable();
            $t->string('course')->nullable();
            $t->string('plan')->nullable();
            $t->timestamps();

        });

        Schema::create('questionnaires',function(Blueprint $t){
            $t->increments('id');
            $t->string('QuestionWorkStatus')->nullable();
            $t->string('QuestionWorkplaceWorkType')->nullable();
            $t->string('QuestionWorkplaceWorkOtherType')->nullable();
            $t->string('QuestionWorkplacePersonalSkill')->nullable();
            $t->string('QuestionWorkplaceWorkSkill')->nullable();
            $t->string('QuestionWorkplaceWorkOtherSkill')->nullable();
            $t->string('QuestionWorkplaceWorkPositionType')->nullable();
            $t->string('QuestionWorkplaceWorkPosition')->nullable();
            $t->string('QuestionWorkplaceName')->nullable();
            $t->string('QuestionWorkplaceNo')->nullable();
            $t->string('QuestionWorkplaceMo')->nullable();
            $t->string('QuestionWorkplaceBuildingName')->nullable();
            $t->string('QuestionWorkplaceBuildingFloor')->nullable();
            $t->string('QuestionWorkplaceSoi')->nullable();
            $t->string('QuestionWorkplaceRoad')->nullable();
            $t->string('QuestionWorkplaceDistrict')->nullable();
            $t->string('QuestionWorkplaceAmphur')->nullable();
            $t->string('QuestionWorkplaceProvince')->nullable();
            $t->string('QuestionWorkplaceZipno')->nullable();
            $t->string('QuestionWorkplacePhoneno')->nullable();
            $t->string('QuestionWorkplacePhoneno1')->nullable();
            $t->string('QuestionWorkplaceFaxno')->nullable();
            $t->string('QuestionWorkplaceEmail')->nullable();
            $t->string('QuestionWorkplaceSalary')->nullable();
            $t->string('QuestionWorkStatus')->nullable();
            $t->string('QuestionWorkplaceSatify')->nullable();
            $t->string('QuestionWorkplaceOtherSatisfy')->nullable();
            $t->string('QuestionWorkFindingDuration')->nullable();
            $t->string('QuestionWorkplaceDirectBranch')->nullable();
            $t->string('QuestionWorkplaceApplyKnowledge')->nullable();
            $t->string('QuestionReasonNotGetWork')->nullable();
            $t->string('QuestionReasonNotGetWorkOther')->nullable();
            $t->string('QuestionFindingJobProblem')->nullable();
            $t->string('QuestionFindingJobProblemOther')->nullable();
            $t->string('QuestionGetHigherEducation')->nullable();
            $t->string('QuestionDegreeOfHigherEducation')->nullable();
            $t->string('QuestionBranchOfHigherEducation')->nullable();
            $t->string('QuestionBranchOfHigherEducationOther')->nullable();
            $t->string('QuestionSchoolTypeOfHigherEducation')->nullable();
            $t->string('QuestionReasonOfGetHigherEducation')->nullable();
            $t->string('QuestionReasonOfGetHigherEducationOther')->nullable();
            $t->string('QuestionProblemOfGetHigherEducationOther')->nullable();
            $t->string('QuestionWorkplaceType')->nullable();
            $t->string('QuestionWorkplaceWorkMasterType')->nullable();
            $t->string('QuestionSubjectForJob1')->nullable();
            $t->string('QuestionSubjectForJob2')->nullable();
            $t->string('QuestionSubjectForJob3')->nullable();
            $t->string('QuestionSubjectForJob4')->nullable();
            $t->string('QuestionSubjectForJob5')->nullable();
            $t->string('QuestionSubjectForJob6')->nullable();
            $t->string('QuestionSubjectForJobOther')->nullable();
            $t->string('QuestionCourseSuggestion')->nullable();
            $t->string('QuestionTeachingSuggestion')->nullable();
            $t->string('QuestionStudentActivitySuggestion')->nullable();
            $t->string('QuestionCourseSuggestion')->nullable();
            $t->string('QuestionTeachingSuggestion')->nullable();
            $t->string('QuestionActivitySuggestion')->nullable();




            $t->timestamps();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
