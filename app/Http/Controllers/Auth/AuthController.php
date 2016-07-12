<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;
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
        } else {
            //check up login
            $data = [
                'Login' => [
                    'username' => base64_encode($login['username']),
                    'password' => base64_encode($login['password']),
                    'ProductName' => 'decaffair_student',
                ]
            ];

            $authService = new \App\Soap\AuthenService();
            $authResult = $authService->call("login", $data);
            $sid = $authResult->LoginResult;

            if ($sid == "") {
                return redirect('/')->withErrors(['up' => 'username or password is invalid.']);
            }

            //staff info
            $data2 = [
                'GetStaffInfo' => [
                    'sessionID' => $sid
                ]
            ];

            $staffService = new \App\Soap\StaffService();
            $staffInfoResult = $staffService->call('GetStaffInfo', $data2)->GetStaffInfoResult;
            if ($staffInfoResult->CitizenID) {

                //check faculty
                if ($staffInfoResult->Faculty != env('FACULTY')) {
                    return redirect('/')->withErrors(['up' => 'Only ' . env('FACULTY') . ' can be logged in.']);
                }

                $userUpProfile = \App\Models\Social\UpProfile::where('username', '=', $login['username'])->first();
                if ($userUpProfile) {
                    //do login
                    $user = $userUpProfile->user;
                    if ($user) {
                        Auth::login($user);
                        return redirect('/admin/index');
                    }

                } else {
                    $type = \App\Models\Social\UpProfileType::where('key', '=', 'teacher')->first();
                    $role = UserType::where('name', '=', 'ADMIN')->first();

                    $upprofile = new \App\Models\Social\UpProfile();
                    $upprofile->firstname = $staffInfoResult->FirstName_TH;
                    $upprofile->lastname = $staffInfoResult->LastName_TH;
                    $upprofile->session_id = $sid;
                    $upprofile->username = $login['username'];
                    $upprofile->password = base64_encode($login['password']);
                    $upprofile->faculty = $staffInfoResult->Faculty;


                    $username = $login['username'];
                    $form = [
                        'username' => $username,
                        'national_id' => $staffInfoResult->CitizenID,
                        'firstname' => $staffInfoResult->FirstName_TH,
                        'lastname' => $staffInfoResult->LastName_TH,
                        'email' => "$username@up.ac.th",
                    ];

                    $user = new User();
                    $user->fill($form);
                    $user->password = \Hash::make($login['password']);
                    $user->usertype()->associate($role);

                    $role->users()->save($user);


                    $user->up()->save($upprofile);
                    $upprofile->upProfileType()->associate($type);

                }
                return redirect('/admin/index');
            }
        }
        return redirect('/')->withErrors(['up' => 'username or password is invalid.']);

    }

    public function postLogout()
    {
        \Auth::logout();
        return redirect('/');
    }
}
