@extends('layouts.app')

@section('content')

        <!-- Bootstrap Boilerplate... -->
@if (session('feedback') && $finishedTasks && $currentTasks)
    <div class="alert alert-success Todos">
        {{ session('feedback') }}
    </div>
    @elseif (!$finishedTasks && $currentTasks)
        <div class="alert alert-warning Todos">
            <p>Damn, seems like you've still got some work left!</p>
        </div>
    @elseif ($finishedTasks && !$currentTasks)
        <div class="alert alert-success Todos">
            <p>You've finished all of your tasks! Good job!</p>
        </div>
@endif
<div class="panel-body">
    <!-- Display Validation Errors -->


            <!-- New Task Form -->
    <form action="{{ url('task') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

                <!-- Task Name -->
        <div class="form-group">
            <label for="task-name" class="col-sm-3 control-label">Task</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="task-name" class="form-control">
                @include('common.errors')
            </div>
        </div>

        <!-- Add Task Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Task
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Current Tasks -->

<div class="panel panel-default Todos">
    @if ($currentTasks)
        <div class="panel-heading">
            Current Tasks
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">

                <!-- Table Headings -->
                <thead>
                <th>&nbsp;</th>
                <th>Task</th>
                <th>&nbsp;</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                @foreach ($tasks as $task)
                    @if($task->status)
                        <tr>

                            <!-- Done Button -->
                            <td>
                                <form class="taskDelete" action="{{ url('taskUpdate/'.$task->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}

                                    <button class="btn btn-success">Done</button>
                                </form>
                            </td>

                            <!-- Task Name -->
                            <td class="table-text taskName">
                                <div>
                                    <p>{{ $task->name }}</p>
                                </div>
                            </td>

                            <!-- Delete Button -->
                            <td>
                                <form action="{{ url('taskDelete/'.$task->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button class="btn btn-danger">Delete Task</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
    @if ($finishedTasks)
        <div class="panel-heading">
            Finished Tasks
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">

                <!-- Table Headings -->
                <thead>
                <th>&nbsp;</th>
                <th>Task</th>
                <th>&nbsp;</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                @foreach ($tasks as $task)
                    @if(!$task->status)
                        <tr>

                            <!-- Done Button -->
                            <td>
                                <form class="taskDelete" action="{{ url('taskUpdate/'.$task->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}

                                    <button class="btn btn-warning">Not Done</button>
                                </form>
                            </td>

                            <!-- Task Name -->
                            <td class="table-text taskName">
                                <div>
                                    <p>{{ $task->name }}</p>
                                </div>
                            </td>

                            <!-- Delete Button -->
                            <td>
                                <form action="{{ url('taskDelete/'.$task->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button class="btn btn-danger">Delete Task</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
<div class="Todos">

</div>
@endsection