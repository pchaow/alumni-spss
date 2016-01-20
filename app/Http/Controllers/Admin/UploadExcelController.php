<?php

namespace App\Http\Controllers\Admin;

use App\Models\Alumni;
use App\Models\Workplace;
use App\User;
use Illuminate\Support\Facades\App;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


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
                    $test = 0;
                    foreach ($dataTest[0] as $data) {
                        //return $data;

                        /**ข้อมูลส่วนตัว**/
                        $input_profile = new Alumni();
                        $input_profile->year_of_graduation = $data->year_of_graduation;
                        $input_profile->national_id = $data->faculty;
                        $input_profile->student_id = $data->branch;
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
                        $input_workplace->alumni()->associate($input_profile);
                        $input_workplace->save();

                    }

                    return redirect('admin/import')->with('status', 'Import Success!!');

                } else {
                    return redirect()->back()->with('status', 'file is valid');
                }
            } else {
                return redirect()->back()->with('status', 'no file xls!!');
            }
        } else {
            return redirect()->back()->with('no file failed');
        }

    }
}
