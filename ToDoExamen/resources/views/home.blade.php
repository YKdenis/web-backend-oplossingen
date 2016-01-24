@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <p>Welcome {{ Auth::user()->name }}!</p>
                    <p>Checkout your ToDo List <a href="{{ url('/tasks') }}">here</a>!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
