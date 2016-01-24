@extends('layouts.app')

@section('content')

        <!-- Bootstrap Boilerplate... -->
<div class="panel-header">

</div>
<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')

            <!-- New Task Form -->
    <form action="{{ url('todo/task/') }}" method="POST" class="form-horizontal clearfix" style="margin: auto; width: 800px;">
        {{ csrf_field() }}
            <!-- Task Name -->
            <div class="form-group" style="float: left; width:600px;">
                <label for="task" class="col-sm-3 control-label " style="width: 50px;">Task</label>

                <div class="col-sm-6" style="width:550px;">
                    <input type="text" name="name" id="task-name" class="form-control">
                </div>
            </div>

            <!-- Add Task Button -->
            <div class="form-group" style="float: left; width:200px;">
                <div class="col-sm-offset-3 col-sm-6" style=" margin-left: 10px;">
                    <button type="submit" class="btn btn-default taskSubmit">
                        <i class="fa fa-plus"></i> Add Task
                    </button>
                </div>
            </div>
    </form>
</div>

<!-- TODO: Current Tasks -->

<!-- Current Tasks -->
@if (count($tasks) > 0)
    <div class="panel panel-default currentTasks">

        <div class="panel-body">
            <table class="table table-striped task-table">

                <!-- Table Headings -->
                <thead>
                <th>&nbsp;</th>
                <th class="alignText">Current tasks</th>
                <th>&nbsp;</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                @foreach ($tasks as $task)
                        <!-- TODO: Delete Button -->
                @if( $task->status )
                    <tr>
                        <!-- Done Button -->
                        <td>
                            <form class="taskDelete" action="{{ url('todo/task/changeStatus/'.$task->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <button class="btn btn-success">Done</button>
                            </form>
                        </td>

                        <!-- Task Name -->
                        <td class="table-text">
                            <div class="alignText">{{ $task->name }}</div>
                        </td>

                        <!-- Delete Button -->
                        <td>
                            <form class="taskDelete" action="{{ url('todo/task/delete/'.$task->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>

                    </tr>
                @endif
                @endforeach
                </tbody>
            </table>

            <table class="table table-striped task-table">

                <!-- Table Headings -->
                <thead>
                <th>&nbsp;</th>
                <th class="alignText">Finished tasks</th>
                <th>&nbsp;</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                @foreach ($tasks as $task)
                        <!-- TODO: Delete Button -->
                @if(!$task->status)
                    <tr>
                        <!-- Not Done Button -->
                        <td>
                            <form class="taskDelete" action="{{ url('todo/task/changeStatus/'.$task->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <button class="btn btn-warning">Not Done</button>
                            </form>
                        </td>

                        <!-- Task Name -->
                        <td class="table-text">
                            <div class="alignText">{{ $task->name }}</div>
                        </td>

                        <!-- Delete Button -->
                        <td>
                            <form class="taskDelete" action="{{ url('todo/task/delete/'.$task->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection