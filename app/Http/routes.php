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

Route::get('/ajax-branch', function () {
    $degree_id = Input::get('degree_id');

    $branch = \App\Models\Alumni::select('branch')
        ->where('degree', '=', $degree_id)
        ->distinct()
        ->orderby('branch', 'ASC')
        ->get();
    return \Illuminate\Support\Facades\Response::json($branch);
});

Route::get('/ajax-yeargrad', function () {
    $branch_id = Input::get('branch_id');

    $yeargrad = \App\Models\Alumni::select('yearofgraduation')
        ->where('branch', '=', $branch_id)
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

        Route::get('/export_excel', 'Admin\ExportExcelController@export_excel');

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


    // Generate a login URL
    Route::get('/facebook/login', function (SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        // Send an array of permissions to request
        $login_url = $fb->getLoginUrl(['email']);

        // Obviously you'd do this in blade :)
        echo '<a href="' . $login_url . '">Login with Facebook</a>';
    });

// Endpoint that is redirected to after an authentication attempt
    Route::get('/facebook/callback', function (SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        // Obtain an access token.
        try {
            $token = $fb->getAccessTokenFromRedirect();
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }
        // Access token will be null if the user denied the request
        // or if someone just hit this URL outside of the OAuth flow.

        if (!$token) {
            // Get the redirect helper
            $helper = $fb->getRedirectLoginHelper();

            if (!$helper->getError()) {
                abort(403, 'Unauthorized action.');
            }

            // User denied the request
            dd(
                $helper->getError(),
                $helper->getErrorCode(),
                $helper->getErrorReason(),
                $helper->getErrorDescription()
            );
        }

        if (!$token->isLongLived()) {
            // OAuth 2.0 client handler
            $oauth_client = $fb->getOAuth2Client();

            // Extend the access token.
            try {
                $token = $oauth_client->getLongLivedAccessToken($token);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }
        }

        $fb->setDefaultAccessToken($token);

        // Save for later
        Session::put('fb_user_access_token', (string)$token);

        // Get basic info on the user from Facebook.
        try {
            $response = $fb->get('/me?fields=id,name,email,picture');
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
        if(Auth::user()){
            $facebook_user = $response->getGraphUser();
            $test = [];
            $test['facebook'] = $facebook_user;
            $user = Auth::user();
            $user->facebook_id = $facebook_user->getId();
            $user->facebook_name = $facebook_user->getName();
            $user->facebook_email = $facebook_user->getEmail();
            $user->facebook_token = (string)$token;
            $user->facebook_profile_url = $facebook_user->getPicture()->getUrl();

            $user->save();
            return redirect('/admin/index')->with('message', 'Successfully logged in with Facebook');
        }else {
            return redirect('/')->with('message', 'You must login with your student id first');
        }





    });

    Route::get('/test/graph',function(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb){
        try {
            $response = $fb->get('/563173463853702/feed?fields=id,from{picture,name},message', Session::get('fb_user_access_token'));
            dd($response->getGraphEdge());
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }
    });

});


