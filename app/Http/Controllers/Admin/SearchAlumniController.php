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
        $data_alumni = Alumni::with('workplace', 'questionnaire')->get();
        return view('admin.search')->with('data_alumni', $data_alumni);;

    }

    public function search_alumni(Request $request)
    {
        $year_of_graduation = Input::get("year_of_graduation");
        $education = Input::get("education");
        $course = Input::get("course");
        $title = Input::get("title");
        $student_id = Input::get("student_id");
        $firstname = Input::get("firstname");
        $lastname = Input::get("lastname");

        $data_alumni = Alumni::with('workplace', 'questionnaire')
            ->where(function ($q) use ($year_of_graduation, $education, $course, $title, $student_id, $firstname, $lastname) {
                return $q->where('year_of_graduation', 'LIKE', "%$year_of_graduation%")
                    ->where('education', 'LIKE', "%$education%")
                    ->where('course', 'LIKE', "%$course%")
                    ->where('title', 'LIKE', "%$title%")
                    ->where('student_id', 'LIKE', "%$student_id%")
                    ->where('firstname', 'LIKE', "%$firstname%")
                    ->where('lastname', 'LIKE', "%$lastname%")
                    ;
            })
            ->orderBy('created_at', 'desc')
            ->get();

       // dd($data_alumni);

        return view('admin/search')->with('data_alumni', $data_alumni);


    }

}
