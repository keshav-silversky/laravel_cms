<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;

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
// Route::patch('/admin/post/update/{post}',[PostController::class,'update'])->name('admin.post.update');

Auth::routes();
 
    Route::get('/admin',[AdminController::class,'index'])->middleware('admin')->name('admin.index');
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/post/{post}',[PostController::class,'show'])->middleware('admin')->name('post');
    
    Route::get('/admin/post/index',[PostController::class,'index'])->name('all.post');
    Route::get('/admin/post/create',[PostController::class,'create'])->name('create.post');
    Route::post('/post/create',[PostController::class,'store'])->name('post.create');

    Route::delete('/admin/post/delete/{post}',[PostController::class,'destroy'])->name('admin.post.destroy');
    Route::get('/admin/post/edit/{post}',[PostController::class,'edit'])->name('post.edit');
    Route::patch('/admin/post-update/{post}',[PostController::class,'update'])->name('admin.post.update');


    
    
    
    