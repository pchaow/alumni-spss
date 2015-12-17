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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin/auth/signin',function(){
   return view('admin.auth.signin');
});

Route::post('/admin/auth/signin',function(){
    $login = \Input::get('login');
    //TODO : เพิ่มขั้นตอนการ login ตรงนี้ สำหรับ ผู้ดูแลระบบ
    return redirect('/admin/index');
});

Route::get('/admin/index',function(){
   return view('admin.index');
});