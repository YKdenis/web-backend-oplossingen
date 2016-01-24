<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// implement the TaskRepository
use App\Repositories\TaskRepository;
// implement the model Task
use App\Task;
use Auth;


class TaskController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;


    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        // inject the array of the TaskRepository into the $tasks array defined at the top.
        $this->tasks = $tasks;
    }


    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', $request->user()->id)->get();
        $currentTasks = false;
        $finishedTasks = false;
        if (count($tasks) > 0) {

            foreach ($tasks as $task) {
                if ($task->status == true) {
                    $currentTasks = true;
                }
                if ($task->status == false) {
                    $finishedTasks = true;
                }
            }
        }

        // The view function accepts a second argument which is an array of data that will be made available to the view,
        // where each key in the array will become a variable within the view.
        return view('tasks.index', [
            'tasks' => $tasks,
            'currentTasks' => $currentTasks,
            'finishedTasks' => $finishedTasks,
        ]);

    }


    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // We don't even have to manually determine if the validation failed or do manual redirection.
        // If the validation fails for the given rules,
        // the user will automatically be redirected back to where they came from and the errors will
        // automatically be flashed to the session. Nice!
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        //the create method will automatically set the user_id property of the given task
        // to the ID of the currently authenticated user, which we are accessing using $request->user()
        $request->user()->tasks()->create([
            'name' => $request->name,
            // if its true the task has not been done yet.
            'status' => true,
        ]);

        $feedback = "The task has been added successfully.";
        return redirect('/tasks')->with('feedback', $feedback);

    }

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    //Since the {task} variable in our route matches the $task variable defined in our controller method,
    // Laravel's implicit model binding will automatically inject the corresponding Task model instance.
    public function destroy(Request $request, Task $task)
    {
        // All Laravel controllers may call an authorize method, which is exposed by the AuthorizesRequest trait
        // The first argument passed to the authorize method is the name of the policy method we wish to call
        // The second argument is the model instance that is our current concern. Remember,
        // we recently told Laravel that our Task model corresponds to our TaskPolicy,
        // so the framework knows on which policy to fire the destroy method.
        // If the action is authorized, our code will continue executing normally.
        // However, if the action is not authorized (meaning the policy's destroy method returned false),
        // a 403 exception will be thrown and an error page will be displayed to the user.

        if(Auth::check()) {
            $this->authorize('destroy', $task);

            $task->delete();

            $feedback = "The task \"" . $task->name . "\" has been deleted!";
            return redirect('/tasks')->with('feedback', $feedback);
        }
        else
        {
            return redirect('/');
        }
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->status = !$task->status;
        $task->save();

        if(!$task->status) {
            $feedback = "You've finished a task!";
        }
        else{
            $feedback = "Hmm... more work...";
        }
        return redirect('/tasks')->with('feedback', $feedback);
    }
}
