<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    public function postSignin()
    {
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

    }

    public function postLogout () {
        \Auth::logout();
        return redirect('/');
    }
}
