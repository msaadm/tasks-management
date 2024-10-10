@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Add a Task</h2>
        </div>
    </div>
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="task_name" name="name" required autocomplete="off">
            <label for="task_name">Task Details</label>
        </div>

        <div class="form-floating mb-3">
            <select class="form-select" id="projectSelect" name="project_id" required>
                <option value=""></option>
                @foreach($projects as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>
            <label for="projectSelect">Project</label>
        </div>

        <div class="text-end">
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Add Task</button>
        </div>
    </form>
@endsection
