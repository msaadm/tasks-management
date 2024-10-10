<?php

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::get('/{project?}', [TasksController::class, 'index'])
    ->name('tasks.index');

Route::post('/tasks', [TasksController::class, 'store'])
    ->name('tasks.store');

Route::post('/tasks/reorder', [TasksController::class, 'reOrder'])
    ->name('tasks.reorder');

Route::get('/tasks/create', [TasksController::class, 'create'])
    ->name('tasks.create');

Route::put('/tasks/{task}', [TasksController::class, 'update'])
    ->name('tasks.update');

Route::delete('/tasks/{task}', [TasksController::class, 'destroy'])
    ->name('tasks.destroy');

Route::get('/tasks/{task}/edit', [TasksController::class, 'edit'])
    ->name('tasks.edit');

// Projects
Route::get('/projects/create', [ProjectsController::class, 'create'])
    ->name('projects.create');

Route::post('/projects', [ProjectsController::class, 'store'])
    ->name('projects.store');
