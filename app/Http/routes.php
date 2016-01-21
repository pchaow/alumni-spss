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


Route::group(['middleware' => ['web']], function () {


    Route::get('/', function () {
        return view('home.signin');
    });


    Route::group(['prefix' => 'admin'], function () {

        Route::get('/auth/signin', function () {
            return view('admin.auth.signin');
        });

        Route::post('/auth/signin', function () {
            $login = Input::get('login');

            //$login['password'] = \Hash::make($login['password']);

            $user = User::where('username', $login['username'])->first();

            if ($user != null) {
                $usertype = $user->usertype()->first();
                if ($usertype->name == "ADMIN") {
                    if (\Hash::check($login['password'], $user->password)) {
                        \Auth::login($user);
                        return redirect('/admin/index');
                    }
                }
            }
            return redirect('/');

        });

        Route::get('/auth/logout', function () {
            \Auth::logout();
            return redirect('/');
        });

        Route::get('/', function () {
            return redirect('/admin/index');
        });

        Route::get('/index', function () {
            return view('admin.index');
        });

        Route::get('/search', 'Admin\SearchAlumniController@get_index');
        Route::post('/search', 'Admin\SearchAlumniController@search_alumni');

        Route::get('/insert', function () {
            return view('admin.data.insert');
        });

        Route::get('/import', function () {
            return view('admin.import');
        });

        Route::get('/stats', function () {
            return view('admin.stats');
        });

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

    Route::get('/test_export_excel', 'TestExcelController@test_export_excel');


    Route::get('/test_import_excel', 'TestExcelController@test_import_excel');


});
