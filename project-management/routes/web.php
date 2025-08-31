<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::get('/', [ProjectController::class, 'index'])->name('dashboard');
Route::resource('projects', ProjectController::class)->except(['show', 'create', 'edit']);
Route::resource('tasks', TaskController::class)->except(['index', 'show', 'create', 'edit']);