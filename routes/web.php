<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PageController;

use Illuminate\Support\Facades\Auth;


Route::group(['prefix'=>'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::get('/', [MainController::class, 'index'])->name('admin.main.index');

    Route::group(['prefix'=>'pages'], function() {
        Route::get('/', [PageController::class, 'index'])->name('admin.page.index');
        Route::get('/create', [PageController::class, 'create'])->name('admin.page.create');
        Route::post('/', [PageController::class, 'store'])->name('admin.page.store');
        Route::get('/{page}', [PageController::class, 'show'])->name('admin.page.show');
        Route::get('/{page}/edit', [PageController::class, 'edit'])->name('admin.page.edit');
        Route::patch('/{page}', [PageController::class, 'update'])->name('admin.page.update');
        Route::delete('/{page}', [PageController::class, 'destroy'])->name('admin.page.destroy');
        Route::get('/{page}/restore', [PageController::class, 'restore'])->name('admin.page.restore');
    });

    Route::group(['prefix'=>'posts'], function() {
        Route::get('/', [PostController::class, 'index'])->name('admin.post.index');
        Route::get('/create', [PostController::class, 'create'])->name('admin.post.create');
        Route::post('/', [PostController::class, 'store'])->name('admin.post.store');
        Route::get('/{post}', [PostController::class, 'show'])->name('admin.post.show');
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('admin.post.edit');
        Route::patch('/{post}', [PostController::class, 'update'])->name('admin.post.update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('admin.post.destroy');
        Route::get('/{post}/restore', [PostController::class, 'restore'])->name('admin.post.restore');
    });

    Route::group(['prefix'=>'categories'], function() {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('admin.category.show');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::patch('/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
        Route::get('/{category}/restore', [CategoryController::class, 'restore'])->name('admin.category.restore');
    });

    Route::group(['prefix'=>'tags'], function() {
        Route::get('/', [TagController::class, 'index'])->name('admin.tag.index');
        Route::get('/create', [TagController::class, 'create'])->name('admin.tag.create');
        Route::post('/', [TagController::class, 'store'])->name('admin.tag.store');
        Route::get('/{tag}', [TagController::class, 'show'])->name('admin.tag.show');
        Route::get('/{tag}/edit', [TagController::class, 'edit'])->name('admin.tag.edit');
        Route::patch('/{tag}', [TagController::class, 'update'])->name('admin.tag.update');
        Route::delete('/{tag}', [TagController::class, 'destroy'])->name('admin.tag.destroy');
        Route::get('/{tag}/restore', [TagController::class, 'restore'])->name('admin.tag.restore');
    });

    Route::group(['prefix'=>'users'], function() {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('/', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/{user}', [UserController::class, 'show'])->name('admin.user.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::patch('/{user}', [UserController::class, 'update'])->name('admin.user.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');
        Route::get('/{user}/restore', [UserController::class, 'restore'])->name('admin.category.restore');
    });


});

Route::get('{page:slug}', \App\Http\Controllers\PageController::class)->name('page');

Auth::routes();
