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
        $yearOfGraduation = \DB::select(
            "select DISTINCT(alumni.yearOfGraduation) as yearOfGraduation from alumni order by yearOfGraduation ");
        $yearOfStartStudy = \DB::select(
            "SELECT DISTINCT(CONCAT('25', SUBSTRING(alumni.student_id from 1 for 2))) as yearOfStudy from alumni order by yearOfStudy");

        $degreeStudy = \DB::select(
            "SELECT DISTINCT(degree) as degree from alumni order by degree");

        $branch = \DB::select(
            "SELECT DISTINCT(branch) as branch from alumni order by branch");

      
        //$data_alumni = Alumni::with('questionnaires')->paginate(25);
        $data_alumni = Alumni::with('questionnaires')->get();
        return view('admin.search')
           ->with('data_alumni', $data_alumni)
            ->with('yearOfGraduation', $yearOfGraduation)
            ->with('yearOfStartStudy', $yearOfStartStudy)
            ->with('degreeStudy', $degreeStudy)
            ->with('branch', $branch);


    }

    public function search_alumni(Request $request)
    {

        // return Input::all();
        $educationYear = substr(Input::get("education_year"), -2);
        $year_of_graduation = Input::get("year_of_graduation");
        $education = Input::get("education");
        $course = Input::get("course");
        $student_id = Input::get("student_id");
        $firstname = Input::get("firstname");
        $lastname = Input::get("lastname");

       


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
           // $data_alumni=$data_alumni->paginate(25);
        $data_alumni=$data_alumni->get();
        $count = $data_alumni->count();
        $yearOfGraduation = \DB::select(
            "select DISTINCT(alumni.yearOfGraduation) as yearOfGraduation from alumni order by yearOfGraduation ");
        $yearOfStartStudy = \DB::select(
            "SELECT DISTINCT(CONCAT('25', SUBSTRING(alumni.student_id from 1 for 2))) as yearOfStudy from alumni order by yearOfStudy");
        $degreeStudy = \DB::select(
            "SELECT DISTINCT(degree) as degree from alumni order by degree");
        $branch = \DB::select(
            "SELECT DISTINCT(branch) as branch from alumni order by branch");



        return view('admin/search')->with('data_alumni', $data_alumni)
            ->with('yearOfGraduation', $yearOfGraduation)
            ->with('yearOfStartStudy', $yearOfStartStudy)
            ->with('degreeStudy', $degreeStudy)
            ->with('branch', $branch)
            ->with('count',$count)
            ->with('form', $request->all());


    }

}
