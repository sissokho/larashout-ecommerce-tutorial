<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('login.post');
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');

        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/', function () {
                return view('admin.dashboard.index');
            })->name('dashboard');

            Route::get('/settings', [SettingController::class, 'index'])->name('settings');
            Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
        });

        Route::prefix('categories')
            ->group(function () {

                Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
                Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
                Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
                Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
                Route::post('/update', [CategoryController::class, 'update'])->name('categories.update');
                Route::get('/{id}/delete', [CategoryController::class, 'delete'])->name('categories.delete');
            });

        Route::prefix('attributes')
            ->group(function () {

                Route::get('/', [AttributeController::class, 'index'])->name('attributes.index');
                Route::get('/create', [AttributeController::class, 'create'])->name('attributes.create');
                Route::post('/store', [AttributeController::class, 'store'])->name('attributes.store');
                Route::get('/{id}/edit', [AttributeController::class, 'edit'])->name('attributes.edit');
                Route::post('/update', [AttributeController::class, 'update'])->name('attributes.update');
                Route::get('/{id}/delete', [AttributeController::class, 'delete'])->name('attributes.delete');
            });
    });
