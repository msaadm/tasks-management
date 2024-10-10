<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created project.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required',
        ]);

        Project::create($validated_data);

        return redirect()->route('tasks.index')->with('success', 'Project created successfully');
    }
}
