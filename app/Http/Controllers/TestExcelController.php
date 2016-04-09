<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Questionaire;
use App\User;
use Illuminate\Support\Facades\App;
use Excel;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use App\Http\Controllers\Schema;



class TestExcelController extends Controller
{

    public function test_export_excel(Request $request)
    {

        $educationYear = substr(Input::get("education_year"), -2);
        $year_of_graduation = Input::get("year_of_graduation");
        $education = Input::get("degree");
        $course = Input::get("course");
        $title = Input::get("title");
        $student_id = Input::get("student_id");
        $firstname = Input::get("firstname");
        $lastname = Input::get("lastname");

        $data_alumni = Alumni::with('questionnaires')
            ->where(function ($q)
            use
            ($educationYear, $year_of_graduation, $education, $course, $title, $student_id, $firstname, $lastname) {
                return $q
                    ->where('student_id', 'LIKE', "$educationYear%")
                    ->where('yearofgraduation', 'LIKE', "%$year_of_graduation%")
                    ->where('degree', 'LIKE', "%$education%")
                    ->where('course', 'LIKE', "%$course%")
                    ->where('title', 'LIKE', "%$title%")
                    ->where('student_id', 'LIKE', "%$student_id%")
                    ->where('firstname', 'LIKE', "%$firstname%")
                    ->where('lastname', 'LIKE', "%$lastname%")
                    ;
            })
            ->orderBy('created_at', 'desc');

        $query = \App\Models\Alumni::query();
        $query->join('questionnaires',function($join){
            $join->on('alumni.id','=','questionnaires.alumni_id');
        });
        $result  = $query->get()->toArray();
        $keys = array_keys($result[0]);
        //$result = Alumni::with('questionnaires')->first();
        dd($result);
        $head = $keys;

        $data = $result;

        Excel::create('Laravel Excel', function ($excel) use ($data, $head) {

            $excel->sheet('Excel sheet', function ($sheet) use ($data, $head) {


                $sheet->prependRow(1, $head);


                $sheet->rows($data);


            });
            // Our first sheet

        })->export('xls');
    }


    public function test_import_excel()
    {

        $dataTest = Excel::load(storage_path('file_excel') . '/Data1.xlsx', function ($reader) {
        })->get();
        dd( $dataTest[0]);
        $test = 0;


    }
}
