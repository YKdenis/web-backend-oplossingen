<?php

namespace App\Policies;
use App\User;
use App\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the given task.
     *
     * @param  User  $user
     * @param  Task  $task
     * @return bool
     */
    //This method will receive a User instance and a Task instance.
    // The method should simply check if the user's ID matches the user_id on the task.
    // In fact, all policy methods should either return true or false
    public function destroy(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
