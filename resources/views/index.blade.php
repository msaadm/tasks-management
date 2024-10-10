@extends('layouts.app')

@section('content')

    @if (session('success'))
        <div id="alertMessage" class="alert alert-success fade show" role="alert">
            <strong><i class="bi bi-check-circle"></i></strong> {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-6">
        <h2>Tasks List</h2>
        </div>
        <div class="col-6 text-end">
            <!-- Button trigger modal -->
            <a type="button" class="btn btn-primary" href="{{ route('tasks.create') }}">
                <i class="bi bi-plus-circle"></i> Add Task
            </a>
            <!-- Button trigger modal -->
            <a type="button" class="btn btn-primary" href="{{ route('projects.create') }}">
                <i class="bi bi-plus-circle"></i> Add Project
            </a>
        </div>
    </div>
    <div class="mb-3">
        <label for="projectSelect" class="form-label">Select Project</label>
        <select class="form-select" id="projectSelect" name="projectSelect">
            <option selected value="">All</option>
            @foreach($projects as $p)
                <option value="{{ $p->id }}"
                    @if($project && $project->id === $p->id) selected @endif
                >{{ $p->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="">
        <ul id="sortable" class="list-group">
            @foreach($tasks as $task)
                <li class="ui-state-default container list-group-item" id="{{ "task_{$task->id}" }}">
                    <div class="row">
                        <div class="col-10">
                            <i class="bi bi-arrows-vertical"></i>{{$task->name}}
                        </div>
                        <div class="col-2 text-end">
                            <a href="{{ route('tasks.edit', [$task->id]) }}" class="p-2">
                                <i class="bi bi-pencil text-primary"></i>
                            </a>

                            <a class="delete-task-link" data-route="{{ route('tasks.destroy', [$task->id]) }}" href="#">
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <form id="taskDeleteForm" method="POST" action="">
        @method('delete')
        @csrf
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $("#sortable").sortable({
                deactivate: function (event, ui) {
                    let sorted = $("#sortable").sortable("serialize", {key: "item"});
                    let sortedQueryParams = new URLSearchParams(sorted);
                    let tasks = [];
                    let counter = 1;
                    for (const [key, task_id] of sortedQueryParams.entries()) {
                        tasks.push({
                            id: task_id,
                            priority: counter,
                        })
                        counter++;
                    }

                    axios.post("{{ route('tasks.reorder') }}", {
                        tasks: tasks
                    }).then(response => {
                        console.log(response)
                    })
                }
            });

            // Get All Task by Project
            $('#projectSelect').change(function () {
                window.location.href = "/"+$(this).val();
            });

            // Delete a task
            $(".delete-task-link").click(function(e) {
                e.preventDefault();
                const taskDeleteRoute = $(this).data('route');
                if (confirm("Are you sure to delete this task?") === true) {
                    $("#taskDeleteForm")
                        .attr('action', taskDeleteRoute)
                        .submit();
                }
            });

            @if (session('success'))
            // If alert message, delete after five seconds
            setTimeout(function () {
                $('#alertMessage').remove();
            }, 5000);
            @endif
        });
    </script>
@endpush
