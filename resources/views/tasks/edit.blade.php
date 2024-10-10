@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Add a Task</h2>
        </div>
    </div>
    <form method="POST" action="{{ route('tasks.update', [$task->id]) }}">
        @csrf
        @method('put')
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="task_name" name="name" value="{{ $task->name }}" required autocomplete="off">
            <label for="task_name">Task Details</label>
        </div>

        <div class="form-floating mb-3">
            <select class="form-select" id="projectSelect" name="project_id" required>
                <option value=""></option>
                @foreach($projects as $p)
                    <option value="{{ $p->id }}"
                        @if($task->project_id === $p->id) selected @endif
                    >{{ $p->name }}</option>
                @endforeach
            </select>
            <label for="projectSelect">Project</label>
        </div>

        <div class="text-end">
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update Task</button>
        </div>
    </form>
@endsection
