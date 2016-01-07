<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Excel;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class TestExcelController extends Controller
{

    public function test_excel()
    {
        $excel = App::make('excel');

        //return $excel;
    }
}
