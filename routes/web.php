<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\ReportController;



Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('category', [CategoryController::class, 'index'])->name('category');


    Route::controller(CategoryController::class)->prefix('category')->group(function () {
        Route::get('', 'index')->name('category');
        Route::get('add', 'add')->name('category.add');
        Route::post('save', 'save')->name('category.save');
        Route::get('edit/{id}', 'edit')->name('category.edit');
        Route::post('edit/{id}', 'update')->name('category.update');
        Route::delete('delete/{id}', 'delete')->name('category.delete');
        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');

    });

    Route::prefix('user')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('user');
    });

    Route::prefix('post')->group(function () {
        Route::get('', [PostController::class, 'index'])->name('post');
        Route::delete('post/delete/{id}', [PostController::class, 'delete'])->name('post.delete');

    });

    Route::controller(ViolationController::class)->prefix('violation')->group(function () {
        Route::get('', 'index')->name('violation');
        Route::get('add', 'add')->name('violation.add');
        Route::post('save', 'save')->name('violation.save');
        Route::get('edit/{id}', 'edit')->name('violation.edit');
        Route::post('edit/{id}', 'update')->name('violation.update');
        Route::delete('/violation/{id}', 'delete')->name('violation.delete');
        Route::get('/violations', [ViolationController::class, 'index'])->name('violation.index');

    });

    Route::get('', [ReportController::class, 'index'])->name('report');

});
