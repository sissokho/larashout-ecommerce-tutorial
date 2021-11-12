<?php

use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('login.post');
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('dashboard')->middleware('auth:admin');
    });
