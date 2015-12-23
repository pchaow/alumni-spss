<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Models\User;

Route::get('/', function () {
    return view('home.signin');
});


Route::get('/admin/auth/signin', function () {
    return view('admin.auth.signin');
});

Route::post('/admin/auth/signin', function () {
    $login = \Input::get('login');

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

Route::get('/admin/auth/logout',function(){
    \Auth::logout();
    return redirect('/');
});

Route::get('/admin', function () {
    return redirect('/admin/index');
});
Route::get('/admin/index', function () {
    return view('admin.index');
});

Route::get('/admin/search', function () {
    return view('admin.search');
});

Route::get('/admin/insert', function () {
    return view('admin.data.insert');
});



///// User //////

Route::get('/user', function () {
    return redirect('/user/index');
});
Route::get('/user/index', function () {
    return view('user.index');
});

Route::get('/user/edit', function () {
    return view('user.profile.edit');
});