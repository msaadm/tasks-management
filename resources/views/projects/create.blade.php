@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Add a Project</h2>
        </div>
    </div>
    <form method="POST" action="{{ route('projects.store') }}">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="project_name" name="name" required autocomplete="off">
            <label for="project_name">Project Name</label>

        </div>
        <div class="text-end">
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Add Project</button>
        </div>
    </form>
@endsection
