<?php

namespace App\Http\Controllers\Admin;

use App\Models\Alumni;
use App\User;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Controllers\Controller;

class SearchAlumniController extends Controller
{


    public function get_index()
    {
        $data_alumni_all = Alumni::count();
        $data_alumni = Alumni::with('questionnaires')->paginate(20);
        return view('admin.search')->with('data_alumni', $data_alumni)->with('data_alumni_all',$data_alumni_all);

    }

    public function search_alumni(Request $request)
    {
        // return Input::all();
        $educationYear = substr(Input::get("education_year"), -2);
        $year_of_graduation = Input::get("year_of_graduation");
        $education = Input::get("degree");
        $course = Input::get("course");
        $title = Input::get("title");
        $student_id = Input::get("student_id");
        $firstname = Input::get("firstname");
        $lastname = Input::get("lastname");
        //echo $year_of_graduation;

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
            ->orderBy('created_at', 'desc')
            ->paginate(20);

          //  $data_alumni = Alumni::with('questionnaires')
          //  ->where('yearofgraduation','LIKE',"%2556.0%")
          //  ->paginate(20);

            //dd($data_alumni);

            //$data_alumni = Alumni::count();
            $data_alumni_all = Alumni::with('questionnaires')
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
                ->count();


        // dd($data_alumni);
        //return Input::all();
        return view('admin/search')->with('data_alumni', $data_alumni)
        ->with('data_alumni_all',$data_alumni_all)
        ;


    }

}
