<?php

namespace App\Http\Controllers\Admin;

use App\Models\Alumni;
use App\Models\Questionnaire;
use App\Models\Workplace;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Controllers\Controller;

class UploadExcelController extends Controller
{

    public function test_export_excel()
    {
        $head = array(
            'ชื่อ', 'นามสกุล', 'เลขบัตร'
        );

        $data = array(
            array('กอไก่', 'ใจดี', '1234566'),
            array('ขอไข่', 'ใจดี', '22222222'),
            array('คอควาย', 'ใจดี', '333333'),
            array('งองู', 'ใจดี', '444444'),
            array('จอจาร', 'ใจดี', '555555'),
            array('ฉอฉิ่ง', 'ใจดี', '6666666'),
        );

        Excel::create('Laravel Excel', function ($excel) use ($data, $head) {

            $excel->sheet('Excel sheet', function ($sheet) use ($data, $head) {


                $sheet->prependRow(1, $head);


                $sheet->rows($data);


            });
            // Our first sheet

        })->export('xls');
    }


    public function import_excel(Request $request)
    {

        $file = $request->file('file_excel');
        $destinationPath = storage_path() . '/file_excel';

        if ($request->hasFile('file_excel')) {
            $filename = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();

            if ($ext == "xls" || $ext == "xlsx") {
                if ($file->isValid()) {
                    $file->move($destinationPath, $filename);

                    $dataTest = Excel::load(storage_path('file_excel') . '/' . $filename, function ($reader) {
                    })->get();
                    //dd($dataTest[0]);

                    foreach ($dataTest[0] as $data) {

                        /**ข้อมูลส่วนตัว**/
                        $input_profile = new Alumni();
                        $input_profile->yearOfGraduation = $data->yearOfGraduation;
                        $input_profile->personal_id = $data->personal_id;
                        $input_profile->student_id = $data->student_id;
                        $input_profile->title = $data->title;
                        $input_profile->firstname = $data->firstname;
                        $input_profile->lastname = $data->lastname;
                        $input_profile->birthdate = $data->birthdate;
                        $input_profile->gpa = $data->gpa;
                        $input_profile->houseNo = $data->houseNo;
                        $input_profile->houseMo = $data->houseMo;
                        $input_profile->houseSoi = $data->houseSoi;
                        $input_profile->houseRoad = $data->houseRoad;
                        $input_profile->houseDistrict = $data->houseDistrict;
                        $input_profile->houseAmphur= $data->houseAmphur;
                        $input_profile->houseProvince = $data->houseProvince;
                        $input_profile->telephone= $data->telephone;
                        $input_profile->houseZipno = $data->houseZipno;
                        $input_profile->email = $data->email;
                        $input_profile->degree = $data->degree;
                        $input_profile->faculty = $data->faculty;
                        $input_profile->branch = $data->branch;
                        $input_profile->plan = $data->plan;
                        $input_profile->course = $data->course;
                        $input_profile->save();
                        /////////////////

                        /**ข้อมูลสถานที่ทำงาน**/
                      /*  $input_workplace = new Workplace();
                        $input_workplace->office = $data->office;
                        $input_workplace->number_office = $data->number_office;
                        $input_workplace->moo_office = $data->moo_office;
                        $input_workplace->building_office = $data->building_office;
                        $input_workplace->class_office = $data->class_office;
                        $input_workplace->soi_office = $data->soi_office;
                        $input_workplace->road_office = $data->road_office;
                        $input_workplace->amphur_office = $data->amphur_office;
                        $input_workplace->district_office = $data->district_office;
                        $input_workplace->province_office = $data->province_office;
                        $input_workplace->zipcode_office = $data->zipcode_office;
                        $input_workplace->phone_office = $data->phone_office;
                        $input_workplace->fax_office = $data->fax_office;
                        $input_workplace->email_office = $data->email_office;
                        $input_workplace->salary = $data->salary;
                        if ($input_profile != null) {
                            $input_workplace->alumni()->associate($input_profile);
                            $input_workplace->save();
                        }*/

                        /**ข้อมูลแบบสอบถาม**/

                        $input_questionnaire = new Questionnaires();
                        $input_questionnaire->QuestionWorkStatus = $data->QuestionWorkStatus;
                        $input_questionnaire->QuestionWorkplaceWorkType = $data->QuestionWorkplaceWorkType;
                        $input_questionnaire->QuestionWorkplaceWorkOtherType = $data->QuestionWorkplaceWorkOtherType;
                        $input_questionnaire->QuestionWorkplacePersonalSkill = $data->QuestionWorkplacePersonalSkill;
                        $input_questionnaire->QuestionWorkplaceWorkSkill = $data->QuestionWorkplaceWorkSkill;
                        $input_questionnaire->QuestionWorkplaceWorkOtherSkill = $data->QuestionWorkplaceWorkOtherSkill;
                        $input_questionnaire->QuestionWorkplaceWorkPositionType = $data->QuestionWorkplaceWorkPositionType;
                        $input_questionnaire->QuestionWorkplaceWorkPosition = $data->QuestionWorkplaceWorkPosition;
                        $input_questionnaire->QuestionWorkplaceName = $data->QuestionWorkplaceName;
                        $input_questionnaire->QuestionWorkplaceNo = $data->QuestionWorkplaceNo;
                        $input_questionnaire->QuestionWorkplaceMo = $data->QuestionWorkplaceMo;
                        $input_questionnaire->QuestionWorkplaceBuildingName= $data->QuestionWorkplaceBuildingName;
                        $input_questionnaire->QuestionWorkplaceBuildingFloor= $data->QuestionWorkplaceBuildingFloor;
                        $input_questionnaire->QuestionWorkplaceSoi= $data->QuestionWorkplaceSoi;
                        $input_questionnaire->QuestionWorkplaceRoad= $data->QuestionWorkplaceRoad;
                        $input_questionnaire->QuestionWorkplaceDistrict= $data->QuestionWorkplaceDistrict;
                        $input_questionnaire->QuestionWorkplaceAmphur= $data->QuestionWorkplaceAmphur;
                        $input_questionnaire->QuestionWorkplaceProvince= $data->QuestionWorkplaceProvince;
                        $input_questionnaire->QuestionWorkplaceZipno= $data->QuestionWorkplaceZipno;
                        $input_questionnaire->QuestionWorkplacePhoneno= $data->QuestionWorkplacePhoneno;
                        $input_questionnaire->QuestionWorkplacePhoneno1= $data->QuestionWorkplacePhoneno1;
                        $input_questionnaire->QuestionWorkplaceFaxno= $data->QuestionWorkplaceFaxno;
                        $input_questionnaire->QuestionWorkplaceEmail= $data->QuestionWorkplaceEmail;
                        $input_questionnaire->QuestionWorkplaceSalary= $data->QuestionWorkplaceSalary;
                        $input_questionnaire->QuestionWorkStatus= $data->QuestionWorkStatus;
                        $input_questionnaire->QuestionWorkplaceSatify= $data->QuestionWorkplaceSatify;
                        $input_questionnaire->QuestionWorkplaceOtherSatisfy= $data->QuestionWorkplaceOtherSatisfy;
                        $input_questionnaire->QuestionWorkFindingDuration= $data->QuestionWorkFindingDuration;
                        $input_questionnaire->QuestionWorkplaceDirectBranch= $data->QuestionWorkplaceDirectBranch;
                        $input_questionnaire->QuestionWorkplaceApplyKnowledge= $data->QuestionWorkplaceApplyKnowledge;
                        $input_questionnaire->QuestionReasonNotGetWork= $data->QuestionReasonNotGetWork;
                        $input_questionnaire->QuestionReasonNotGetWorkOther= $data->QuestionReasonNotGetWorkOther;
                        $input_questionnaire->QuestionFindingJobProblem= $data->QuestionFindingJobProblem;
                        $input_questionnaire->QuestionFindingJobProblemOther= $data->QuestionFindingJobProblemOther;
                        $input_questionnaire->QuestionGetHigherEducation= $data->QuestionGetHigherEducation;
                        $input_questionnaire->QuestionDegreeOfHigherEducation= $data->QuestionDegreeOfHigherEducation;
                        $input_questionnaire->QuestionBranchOfHigherEducation= $data->QuestionBranchOfHigherEducation;
                        $input_questionnaire->QuestionBranchOfHigherEducationOther= $data->QuestionBranchOfHigherEducationOther;
                        $input_questionnaire->QuestionSchoolTypeOfHigherEducation= $data->QuestionSchoolTypeOfHigherEducation;
                        $input_questionnaire->QuestionReasonOfGetHigherEducation= $data->QuestionReasonOfGetHigherEducation;
                        $input_questionnaire->QuestionReasonOfGetHigherEducationOther= $data->QuestionReasonOfGetHigherEducationOther;
                        $input_questionnaire->QuestionProblemOfGetHigherEducation= $data->QuestionProblemOfGetHigherEducation;
                        $input_questionnaire->QuestionProblemOfGetHigherEducationOther= $data->QuestionProblemOfGetHigherEducationOther;
                        $input_questionnaire->QuestionWorkplaceType= $data->QuestionWorkplaceType;
                        $input_questionnaire->QuestionWorkplaceWorkMasterType= $data->QuestionWorkplaceWorkMasterType;
                        $input_questionnaire->QuestionSubjectForJob1= $data->QuestionSubjectForJob1;
                        $input_questionnaire->QuestionSubjectForJob2= $data->QuestionSubjectForJob2;
                        $input_questionnaire->QuestionSubjectForJob3= $data->QuestionSubjectForJob3;
                        $input_questionnaire->QuestionSubjectForJob4= $data->QuestionSubjectForJob4;
                        $input_questionnaire->QuestionSubjectForJob5= $data->QuestionSubjectForJob5;
                        $input_questionnaire->QuestionSubjectForJob6= $data->QuestionSubjectForJob6;
                        $input_questionnaire->QuestionSubjectForJobOther= $data->QuestionSubjectForJobOther;
                        $input_questionnaire->QuestionCourseSuggestion= $data->QuestionCourseSuggestion;
                        $input_questionnaire->QuestionTeachingSuggestion= $data->QuestionTeachingSuggestion;
                        $input_questionnaire->QuestionStudentActivitySuggestion= $data->QuestionStudentActivitySuggestion;
                        $input_questionnaire->QuestionCourseSuggestion= $data->QuestionCourseSuggestion;
                        $input_questionnaire->QuestionTeachingSuggestion= $data->QuestionTeachingSuggestion;
                        $input_questionnaire->QuestionActivitySuggestion= $data->QuestionActivitySuggestion;

                        if ($input_profile != null) {
                            $input_questionnaire->alumni()->associate($input_profile);
                            $input_questionnaire->save();
                        }
                    }

                    return redirect('admin/import')->with('status', 'Import Success!!');

                } else {
                    return redirect()->back()->with('status', 'file is valid');
                }
            } else {
                return redirect()->back()->with('status', 'no file xls or xlsx!!');
            }
        } else {
            return redirect()->back()->with('no file failed');
        }

    }
}
