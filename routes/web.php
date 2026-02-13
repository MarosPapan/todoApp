<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskManager;


Route::get('login', [AuthController::class, 'login'])->name("login");

Route::post('login', [AuthController::class, 'loginPost'])->name("login.post");

Route::get('register', [AuthController::class, 'register'])->name("register");

Route::post('register', [AuthController::class, 'registerPost'])->name("register.post");

Route::middleware('auth')->group(function () {
    Route::get('/', [TaskManager::class, 'listTasks'])->name("home");

    Route::get('logout', [AuthController::class, 'logout'])->name("logout");

    Route::get("task/add", [TaskManager::class, 'addTask'])->name("task.add");

    Route::post("task/add", [TaskManager::class, 'addTaskPost'])->name("task.add.post");
    
    Route::patch('/tasks/{task}/toggle', [TaskManager::class, 'toggle'])
    ->name('tasks.toggle');

    Route::get('/task/{id}/edit', [TaskManager::class, 'editTask'])->name('task.edit');

    Route::patch('/task/{id}', [TaskManager::class, 'updateTask'])->name('task.update');

    Route::delete("task/delete/{id}", [TaskManager::class, 'deleteTask'])->name("task.delete");

});