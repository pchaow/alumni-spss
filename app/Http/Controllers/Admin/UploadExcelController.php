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
                        $input_profile->year_of_graduation = $data->year_of_graduation;
                        $input_profile->national_id = $data->national_id;
                        $input_profile->student_id = $data->student_id;
                        $input_profile->title = $data->title;
                        $input_profile->firstname = $data->firstname;
                        $input_profile->lastname = $data->lastname;
                        $input_profile->birthdate = $data->birthdate;
                        $input_profile->gpa = $data->gpa;
                        $input_profile->house_no = $data->house_no;
                        $input_profile->moo = $data->moo;
                        $input_profile->soi = $data->soi;
                        $input_profile->road = $data->road;
                        $input_profile->district = $data->district;
                        $input_profile->amphur = $data->amphur;
                        $input_profile->province = $data->province;
                        $input_profile->phone = $data->phone;
                        $input_profile->zipcode = $data->zipcode;
                        $input_profile->email = $data->email;
                        $input_profile->education = $data->education;
                        $input_profile->faculty = $data->faculty;
                        $input_profile->branch = $data->branch;
                        $input_profile->firstname = $data->firstname;
                        $input_profile->course = $data->course;
                        $input_profile->save();
                        /////////////////

                        /**ข้อมูลสถานที่ทำงาน**/
                        $input_workplace = new Workplace();
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
                        }


                        /**ข้อมูลแบบสอบถาม**/

                        $input_questionnaire = new Questionnaire();
                        $input_questionnaire->the_knowledge_that_students_applied_to_work_done = $data->the_knowledge_that_students_applied_to_work_done;
                        $input_questionnaire->reasons_to_study = $data->reasons_to_study;
                        $input_questionnaire->the_reason_is_that_no_jobs = $data->the_reason_is_that_no_jobs;
                        $input_questionnaire->work_directly_with_the_subject_matter = $data->work_directly_with_the_subject_matter;
                        $input_questionnaire->issues_in_education = $data->issues_in_education;
                        $input_questionnaire->field_of_study = $data->field_of_study;
                        $input_questionnaire->to_study_or_not = $data->to_study_or_not;
                        $input_questionnaire->talent_helps_to_work = $data->talent_helps_to_work;
                        $input_questionnaire->time_to_get_the_job_done = $data->time_to_get_the_job_done;
                        $input_questionnaire->difficulties_in_finding_jobs = $data->difficulties_in_finding_jobs;
                        $input_questionnaire->agencies = $data->agencies;
                        $input_questionnaire->satisfaction_with_the_work_done = $data->satisfaction_with_the_work_done;
                        $input_questionnaire->functional_status = $data->functional_status;
                        $input_questionnaire->position = $data->position;
                        $input_questionnaire->category = $data->category;
                        $input_questionnaire->types_of_work = $data->types_of_work;
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
