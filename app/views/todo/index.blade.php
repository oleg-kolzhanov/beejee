@extends('layouts.app')

@section('content')
    <h1 class="mb-4">ToDo</h1>
    <div class="text-end mb-4">
        <a href="/add" class="btn btn-lg btn-outline-light" role="button">Add</a>
    </div>
    <table id="data" class="table table-striped" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Task</th>
            <th>Status</th>
            <th></th>
        </tr>
        </thead>
    </table>
@endsection