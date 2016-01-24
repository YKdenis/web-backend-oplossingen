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


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home', function () {
        return view('welcome');
    });

    Route::get('/dashboard' , function () {
        if(Auth::check()) {
            return view('home');
        }
        else{

            $feedback = "You have to log in before you can access that page!";
            return redirect('login')->with('feedback', $feedback);
        }
    });

    // Add the authentication routes to our routes file.
    // We can do this using the auth method on the Route facade,
    // which will register all of the routes we need for registration, login, and password reset:
    Route::auth();

    Route::get('/tasks', 'TaskController@index');

    Route::post('/task', 'TaskController@store');

    Route::delete('/taskDelete/{task}', 'TaskController@destroy');

    Route::put('/taskUpdate/{task}', 'TaskController@update');

});
