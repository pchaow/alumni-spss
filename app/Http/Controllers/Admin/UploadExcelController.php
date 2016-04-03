<?php

namespace App\Http\Controllers\Admin;

use App\Models\Alumni;
use App\Models\Questionnaire;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Controllers\Controller;

class UploadexcelController extends Controller
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

        excel::create('Laravel excel', function ($excel) use ($data, $head) {

            $excel->sheet('excel sheet', function ($sheet) use ($data, $head) {


                $sheet->prependRow(1, $head);
                $sheet->rows($data);


            });
            // our first sheet

        })->export('xls');
    }


    public function import_excel(Request $request)
    {

        $file = $request->file('file_excel');
        $destinationpath = storage_path() . '/file_excel';

        if ($request->hasfile('file_excel')) {
            $filename = $file->getClientoriginalname();
            $ext = $file->getClientoriginalextension();

            if ($ext == "xls" || $ext == "xlsx") {
                if ($file->isValid()) {
                    $file->move($destinationpath, $filename);

                    $datatest = excel::load(storage_path('file_excel') . '/' . $filename, function ($reader) {
                    })->get();
                    //dd($datatest[0]);
                    foreach ($datatest as $data) {
                        /**ข้อมูลส่วนตัว**/
                        //$data = $datatest[0];
                        $input_profile = new alumni();
                        $input_profile->yearofgraduation = $data->yearofgraduation;
                        $input_profile->personal_id = $data->personal_id;
                        $input_profile->student_id = $data->student_id;
                        $input_profile->title = $data->title;
                        $input_profile->firstname = $data->firstname;
                        $input_profile->lastname = $data->lastname;
                        $input_profile->birthdate = $data->birthdate;
                        $input_profile->gpa = $data->gpa;
                        $input_profile->houseno = $data->houseno;
                        $input_profile->housemo = $data->housemo;
                        $input_profile->housesoi = $data->housesoi;
                        $input_profile->houseroad = $data->houseroad;
                        $input_profile->housedistrict = $data->housedistrict;
                        $input_profile->houseamphur= $data->houseamphur;
                        $input_profile->houseprovince = $data->houseprovince;
                        $input_profile->telephone= $data->telephone;
                        $input_profile->housezipno = $data->housezipno;
                        $input_profile->email = $data->email;
                        $input_profile->degree = $data->degree;
                        $input_profile->faculty = $data->faculty;
                        $input_profile->branch = $data->branch;
                        $input_profile->plan = $data->plan;
                        $input_profile->course = $data->course;
                        $input_profile->save();
                        /////////////////

                        /**ข้อมูลแบบสอบถาม**/
                        $input_questionnaire = new questionnaire();
                        $input_questionnaire->questionworkstatus = $data->questionworkstatus;
                        $input_questionnaire->questionworkplaceworktype = $data->questionworkplaceworktype;
                        $input_questionnaire->questionworkplaceworkothertype = $data->questionworkplaceworkothertype;
                        $input_questionnaire->questionworkplacepersonalskill = $data->questionworkplacepersonalskill;
                        $input_questionnaire->questionworkplaceworkskill = $data->questionworkplaceworkskill;
                        $input_questionnaire->questionworkplaceworkotherskill = $data->questionworkplaceworkotherskill;
                        $input_questionnaire->questionworkplaceworkpositiontype = $data->questionworkplaceworkpositiontype;
                        $input_questionnaire->questionworkplaceworkposition = $data->questionworkplaceworkposition;
                        $input_questionnaire->questionworkplacename = $data->questionworkplacename;
                        $input_questionnaire->questionworkplaceno = $data->questionworkplaceno;
                        $input_questionnaire->questionworkplaceMo = $data->questionworkplaceMo;
                        $input_questionnaire->questionworkplacebuildingname= $data->questionworkplacebuildingname;
                        $input_questionnaire->questionworkplacebuildingfloor= $data->questionworkplacebuildingfloor;
                        $input_questionnaire->questionworkplacesoi= $data->questionworkplacesoi;
                        $input_questionnaire->questionworkplaceRoad= $data->questionworkplaceroad;
                        $input_questionnaire->questionworkplacedistrict= $data->questionworkplacedistrict;
                        $input_questionnaire->questionworkplaceamphur= $data->questionworkplaceamphur;
                        $input_questionnaire->questionworkplaceprovince= $data->questionworkplaceprovince;
                        $input_questionnaire->questionworkplacezipno= $data->questionworkplacezipno;
                        $input_questionnaire->questionworkplacephoneno= $data->questionworkplacephoneno;
                        $input_questionnaire->questionworkplacephoneno1= $data->questionworkplacephoneno1;
                        $input_questionnaire->questionworkplacefaxno= $data->questionworkplacefaxno;
                        $input_questionnaire->questionworkplaceemail= $data->questionworkplaceemail;
                        $input_questionnaire->questionworkplacesalary= $data->questionworkplacesalary;
                        $input_questionnaire->questionworkplacesatify= $data->questionworkplacesatify;
                        $input_questionnaire->questionworkplaceothersatisfy= $data->questionworkplaceothersatisfy;
                        $input_questionnaire->questionworkfindingduration= $data->questionworkfindingduration;
                        $input_questionnaire->questionworkplacedirectbranch= $data->questionworkplacedirectbranch;
                        $input_questionnaire->questionworkplaceapplyKnowledge= $data->questionworkplaceapplyKnowledge;
                        $input_questionnaire->questionreasonnotgetwork= $data->questionreasonnotgetwork;
                        $input_questionnaire->questionreasonnotgetworkother= $data->questionreasonnotgetworkother;
                        $input_questionnaire->questionfindingjobproblem= $data->questionfindingjobproblem;
                        $input_questionnaire->questionfindingjobproblemother= $data->questionfindingjobproblemother;
                        $input_questionnaire->questiongethighereducation= $data->questiongethighereducation;
                        $input_questionnaire->questiondegreeofhighereducation= $data->questiondegreeofhighereducation;
                        $input_questionnaire->questionbranchofhighereducation= $data->questionbranchofhighereducation;
                        $input_questionnaire->questionbranchofhighereducationother= $data->questionbranchofhighereducationother;
                        $input_questionnaire->questionschooltypeofhighereducation= $data->questionschooltypeofhighereducation;
                        $input_questionnaire->questionreasonofgethighereducation= $data->questionreasonofgethighereducation;
                        $input_questionnaire->questionreasonofgethighereducationother= $data->questionreasonofgethighereducationother;
                        $input_questionnaire->questionproblemofgethighereducation= $data->questionproblemofgethighereducation;
                        $input_questionnaire->questionproblemofgethighereducationother= $data->questionproblemofgethighereducationother;
                        $input_questionnaire->questionworkplacetype= $data->questionworkplacetype;
                        $input_questionnaire->questionworkplaceworkMastertype= $data->questionworkplaceworkmastertype;
                        $input_questionnaire->questionsubjectforjob1= $data->questionsubjectforjob1;
                        $input_questionnaire->questionsubjectforjob2= $data->questionsubjectforjob2;
                        $input_questionnaire->questionsubjectforjob3= $data->questionsubjectforjob3;
                        $input_questionnaire->questionsubjectforjob4= $data->questionsubjectforjob4;
                        $input_questionnaire->questionsubjectforjob5= $data->questionsubjectforjob5;
                        $input_questionnaire->questionsubjectforjob6= $data->questionsubjectforjob6;
                        $input_questionnaire->questionsubjectforjobother= $data->questionsubjectforjobother;
                        $input_questionnaire->questionstudentactivitysuggestion= $data->questionstudentactivitysuggestion;
                        $input_questionnaire->questionCoursesuggestion= $data->questioncoursesuggestion;
                        $input_questionnaire->questionteachingsuggestion= $data->questionteachingsuggestion;
                        $input_questionnaire->questionactivitysuggestion= $data->questionactivitysuggestion;

                        if ($input_profile != null) {
                            $input_questionnaire->alumni()->associate($input_profile);
                            $input_questionnaire->save();
                        }
                  }

                    return redirect('admin/import')->with('status', 'Import success!!');

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
