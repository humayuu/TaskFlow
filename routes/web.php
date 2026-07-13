<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('main.dashboard');
    });

    Route::get("/users/status/{id}", [UserController::class, 'updateStatus'])->name('users.status.update');
    Route::resource('users', UserController::class);
    Route::resource('task', TaskController::class);
});
