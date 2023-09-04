<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/master',function(){

    return view('components.master');
});
Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
Route::get('/post/{post}',[PostController::class,'show'])->name('post');
