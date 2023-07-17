@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Add ToDo</h1>
    <form action="/create" method="post" class="row g-3 needs-validation" novalidate>
        <div class="col-md-6">
            <label for="inputName" class="form-label">Name</label>
            <input type="text" class="form-control" id="inputName" name="name" required>
            <div class="invalid-name">
                Please enter a name.
            </div>
        </div>
        <div class="col-md-6">
            <label for="inputEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputEmail" name="email" required>
            <div class="invalid-email">
                Please enter a email.
            </div>
        </div>
        <div class="mb-3">
            <label for="inputText" class="form-label">Text</label>
            <textarea class="form-control" id="inputText" rows="6" name="text"></textarea>
        </div>
        <div class="invalid-email">
            Please enter a text.
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-lg btn-light mb-3">Save</button>
        </div>
    </form>
@endsection