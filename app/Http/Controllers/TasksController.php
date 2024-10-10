<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index(Project $project = null)
    {
        if ($project) {
            $tasks = $project->tasks()->orderBy('priority')->get();
        } else {
            $tasks = Task::orderBy('priority')->get();
        }

        $projects = Project::all();
        return view('index', compact('projects', 'tasks', 'project'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('tasks.create', compact('projects'));
    }

    /**
     * Store a newly created task in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $validated_data = $this->validateRequest();

        $validated_data['priority'] = 9999;

        Task::create($validated_data);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    public function edit(Task $task)
    {
        $projects = Project::all();
        return view('tasks.edit', compact('projects', 'task'));
    }

    /**
     * Update the specified task in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Task $task)
    {
        $validated_data = $this->validateRequest();

        $task->update($validated_data);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified task from storage.
     *
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
 */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }

    public function reOrder(Request $request)
    {
        if ($request->tasks && is_array($request->tasks)) {
            foreach ($request->tasks as $task) {
                Task::find($task['id'])->update(['priority' => $task['priority']]);
            }
        }
    }

    /**
     * @return array
     */
    public function validateRequest(): array
    {
        return request()->validate([
            'name' => 'required',
            'project_id' => 'required',
        ]);
    }
}
