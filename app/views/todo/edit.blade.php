@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Edit ToDo</h1>
    <form action="/update/{{ $todo->id }}" method="post" class="row g-3 needs-validation" novalidate>
        <div class="col-md-6">
            <label for="inputName" class="form-label">Name</label>
            <input type="text" class="form-control" id="inputName" name="name" value="{{ $todo->name }}" disabled>
        </div>
        <div class="col-md-6">
            <label for="inputEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputEmail" name="email" value="{{ $todo->email }}" disabled>
        </div>
        <div class="mb-3">
            <label for="inputText" class="form-label">Text</label>
            <textarea class="form-control" id="inputText" rows="6" name="text">{{ $todo->text }}</textarea>
        </div>
        <div class="invalid-email">
            Please enter a text.
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input type="hidden" name="done" value="false">
                <input class="form-check-input" type="checkbox" name="done" value="true" id="inputDone" {{ $todo->done ? ' checked' : '' }}>
                <label class="form-check-label" for="inputDone">
                    Done
                </label>
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-lg btn-light mb-3">Save</button>
        </div>
    </form>
@endsection