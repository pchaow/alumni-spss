<?php

namespace App\Http\Controllers\Admin;

use App\Models\Alumni;
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
                  // dd($dataTest[0]);
                    $test = 0;
                    foreach ($dataTest[0] as $data) {
                        //return $data;

                        /**ข้อมูลส่วนตัว**/
                        $input = new Alumni();
                        $input->year_of_graduation = $data->year_of_graduation;
                        $input->national_id = $data->faculty;
                        $input->student_id = $data->branch;
                        $input->title = $data->title;
                        $input->firstname = $data->firstname;
                        $input->lastname = $data->lastname;
                        $input->birthdate = $data->birthdate;
                        $input->gpa = $data->gpa;
                        $input->house_no = $data->house_no;
                        $input->moo = $data->moo;
                        $input->soi = $data->soi;
                        $input->road = $data->road;
                        $input->district = $data->district;
                        $input->amphur = $data->amphur;
                        $input->province = $data->province;
                        $input->phone = $data->phone;
                        $input->zipcode = $data->zipcode;
                        $input->email = $data->email;
                        $input->education = $data->education;
                        $input->faculty = $data->faculty;
                        $input->branch = $data->branch;
                        $input->firstname = $data->firstname;
                        $input->course = $data->course;
                        /////////////////




                        $input->save();
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