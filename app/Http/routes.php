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

Route::get('/admin', function () {
    return redirect('/admin/index');
});
Route::get('/admin/index', function () {
    return view('admin.index');
});
