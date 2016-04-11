<?php

namespace App\Http\Controllers\Admin;

use App\Models\Alumni;
use App\Models\Questionaire;
use App\User;
use Illuminate\Support\Facades\App;
use Excel;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class ExportExcelController extends Controller
{

    public function export_excel(Request $request)
    {

        $educationYear = substr(Input::get("education_year"), -2);
        $year_of_graduation = Input::get("year_of_graduation");
        $education = Input::get("education");
        $course = Input::get("course");
        $student_id = Input::get("student_id");
        $firstname = Input::get("firstname");
        $lastname = Input::get("lastname");

        //echo $education;

        $data_alumni = Alumni::query();
        if(Input::has("education_year")){
            $data_alumni->where('student_id', 'LIKE', "$educationYear%");
        }
        if(Input::has("year_of_graduation")){
            $data_alumni->where('yearofgraduation', 'LIKE', "%$year_of_graduation%");
        }
        if(Input::has("education")){
            $data_alumni->where('degree', 'LIKE', "%$education%");
        }
        if(Input::has("course")){
            $data_alumni->where('branch', 'LIKE', "%$course%");
        }
        if(Input::has("student_id")){
            $data_alumni->where('student_id', 'LIKE', "%$student_id%");
        }
        if(Input::has("firstname")){
            $data_alumni->where('firstname', 'LIKE', "%$firstname%");
        }
        if(Input::has("lastname")){
            $data_alumni->where('lastname', 'LIKE', "%$lastname%");
        }

        $data_alumni->orderBy('yearofgraduation', 'asc');
        $data_alumni->orderBy('student_id', 'asc');
        $result =$data_alumni->get()->toArray();
        
       // $result  = $query->get()->toArray();
        $keys = array_keys($result[0]);
        //$result = Alumni::with('questionnaires')->first();
       // dd($result);
        $head = $keys;

        $data = $result;

        Excel::create('Alumni_SPSS_Excel', function ($excel) use ($data, $head) {

            $excel->sheet('Excel sheet', function ($sheet) use ($data, $head) {


                $sheet->prependRow(1, $head);


                $sheet->rows($data);


            });
            // Our first sheet

        })->export('xls');
    }
}
