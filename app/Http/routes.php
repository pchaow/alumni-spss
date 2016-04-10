<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Support\Facades\Input;
use App\Models\User;
//use App\Models\Alumni;

Route::get('/ajax-branch',function(){
   $degree_id = Input::get('degree_id');

    $branch =  \App\Models\Alumni::select('branch')
        ->where('degree','=',$degree_id)
        ->distinct()
        ->orderby('branch', 'ASC')
        ->get();
    return \Illuminate\Support\Facades\Response::json($branch);
});

Route::get('/ajax-yeargrad',function(){
    $branch_id = Input::get('branch_id');

    $yeargrad =  \App\Models\Alumni::select('yearofgraduation')
        ->where('branch','=',$branch_id)
        ->distinct()
        ->orderby('yearofgraduation', 'DESC')
        ->get();
    return \Illuminate\Support\Facades\Response::json($yeargrad);
});


Route::group(['middleware' => ['web']], function () {



    Route::get('/', function () {
        return view('home.signin');
    });


    Route::group(['prefix' => 'admin'], function () {

        Route::post('/auth/signin', "Auth\AuthController@postSignin");

        Route::get('/auth/logout', "Auth\AuthController@postLogout");

        Route::get('/', function () {
            return redirect('/admin/index');
        });

        Route::get('/index', function () {
            return view('admin.index');
        });

        Route::get('/profile/{id}', function ($id) {
            $alumni = \App\Models\Alumni::find($id);
            return view('admin.view_profile')
                ->with('alumni', $alumni);
        });

        Route::get('/search', 'Admin\SearchAlumniController@get_index');


        Route::post('/search', 'Admin\SearchAlumniController@search_alumni');

        Route::get('/insert', function () {
            return view('admin.data.insert');
        });

        Route::get('/import', function () {
            return view('admin.import');
        });
        

        //Read
        Route::get('/stats/{viewName}', function ($viewName) {
            return view("admin.stats.$viewName");
        });

     /*   Route::get('/stats/map', function () {
            return view('admin.stats.map');
        });
*/

        Route::get('/test', 'TestExcelController@test_export_excel');

        Route::post('/import_excel', 'Admin\UploadExcelController@import_excel');


    });


    Route::group(['prefix' => 'user'], function () {

        Route::get('/', function () {
            return redirect('/user/index');
        });
        Route::get('/index', function () {
            return view('user.index');
        });

        Route::get('/edit', function () {
            return view('user.profile.edit');
        });
        Route::get('/search', function () {
            return view('user.search');
        });
    });


    Route::get('/test_import_excel', 'TestExcelController@test_import_excel');


});
