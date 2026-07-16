<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthRoleMiddleware;
use App\Http\Middleware\UpdateTaskStatusMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('login');
});

Route::middleware(['auth', 'check-status'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'dashboard');
    });

    Route::get('/users/status/{id}', [UserController::class, 'updateStatus'])
        ->name('users.status.update');

    Route::resource('users', UserController::class)->middleware(AuthRoleMiddleware::class);
    Route::resource('task', TaskController::class)->middleware(UpdateTaskStatusMiddleware::class);
});
