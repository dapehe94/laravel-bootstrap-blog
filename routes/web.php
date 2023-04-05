<?php
// Dashboard Controllers
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\PostController as DashboardPostController;
use App\Http\Controllers\Dashboard\CategoryController as DashboardCategoryController;
use App\Http\Controllers\Dashboard\TagController as DashboardTagController;
use App\Http\Controllers\Dashboard\CommentController as DashboardCommentController;
use App\Http\Controllers\Dashboard\UserController as DashboardUserController;

// Front Controllers
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\PostController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\TagController;
use App\Http\Controllers\Front\CommentController;
use App\Http\Controllers\Front\UserController;

use Illuminate\Foundation\Application;
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

// Dashboard Routes
Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    Route::controller(DashboardPostController::class)->group(function () {
        Route::get('/posts', 'index')->name('post.index');
        Route::get('/post', 'create')->name('post.create');    
        Route::post('/post', 'store')->name('post.store');
        Route::delete('/post/{post}', 'destroy')->name('post.destroy');
        Route::get('/post/{post}', 'edit')->name('post.edit');
        Route::post('/post/{post}', 'update')->name('post.update');
    });

    Route::controller(DashboardCategoryController::class)->group(function () {
        Route::get('/category', 'create')->name('category.create');    
        Route::post('/category', 'store')->name('category.store');  
    });

    Route::controller(DashboardTagController::class)->group(function () {
        Route::get('/tag', 'create')->name('tag.create');    
        Route::post('/tag', 'store')->name('tag.store'); 
    });

    Route::controller(DashboardCommentController::class)->group(function () {
        Route::get('/comments', 'index')->name('comment.index');
        Route::patch('/comment/{comment}', 'update')->name('comment.update');
        Route::delete('/comment/{comment}', 'destroy')->name('comment.destroy');
    });

    Route::controller(DashboardUserController::class)->group(function () {
        Route::get('/users', 'index')->name('user.index');
        Route::get('/user', 'create')->name('user.create');
        Route::post('/user', 'store')->name('user.store');
        Route::get('/user/{id}', 'show')->name('user.show');
    });

    
});

// Front Routes
Route::get('/', [FrontController::class, 'index'])->name('home.index');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::post('comment', [CommentController::class, 'store'])->name('comment.store');
});


// Post Controller - MANTENER AL FINAL CATCH ALL
Route::get('/{post:slug}', [PostController::class, 'show'])->name('post.show');
Route::get('/c/{category:slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/t/{tag:slug}', [TagController::class, 'show'])->name('tag.show');