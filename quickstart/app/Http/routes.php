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
use App\Task;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {


    // Protected route by using 'middleware' => 'auth'
    Route::get('/todo', ['middleware' => 'auth', function () {
        $tasks = Task::orderBy('created_at', 'asc')->get();

        return view('tasks', [
            'tasks' => $tasks
        ]);
    }]);

    /**
     * Add A New Task
     */
    Route::post('/todo/task', ['middleware' => 'auth', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $task = new Task;
        $task->name = $request->name;
        $task->status = true;
        $task->save();

        return redirect('/todo');
    }]);

    /**
     * Delete An Existing Task
     */

    Route::delete('/todo/task/delete/{task}', ['middleware' => 'auth', function (Task $task) {
        $task->delete();

        return redirect('/todo');
    }]);

    /**
     * Change the status of a task
     */

    Route::put('/todo/task/changeStatus/{task}', ['middleware' => 'auth', function (Task $task) {
        $task->status = !$task->status;
        $task->save();

        return redirect('/todo');
    }]);
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
    Route::get('/', 'HomeController@index');
});
