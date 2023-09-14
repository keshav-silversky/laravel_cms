<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

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
 
    Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
    Route::get('/', [HomeController::class, 'index'])->name('home');
  
    Route::get('/post/{post}',[PostController::class,'show'])->middleware('admin')->name('post');
  
    // Route::get('/post/post/{post}',[PostController::class,'show'])->middleware('admin')->name('post'); // Test Route

    Route::get('/admin/post/index',[PostController::class,'index'])->name('all.post');
    Route::get('/admin/post/create',[PostController::class,'create'])->name('create.post');
    Route::post('/post/create',[PostController::class,'store'])->name('post.create');

    // Route::delete('/admin/post/delete/{post}',[PostController::class,'destroy'])->name('admin.post.destroy');
    Route::delete('/admin/post/delete/{post}',[PostController::class,'destroy'])->name('admin.post.destroy')->middleware('can:delete,post');

    Route::get('/admin/post/edit/{post}',[PostController::class,'edit'])->name('post.edit');
    Route::patch('/admin/post-update/{post}',[PostController::class,'update'])->name('admin.post.update');




    // Route::get('admin/users',[UserController::class,'index'])->name('admin.users');
    Route::delete('admin/users/delete/{user}',[UserController::class,'destroy'])->name('admin.user.delete');

    Route::middleware('roleAuthenticate:admin')->group(function(){
        Route::get('admin/users',[UserController::class,'index'])->name('admin.users');
        Route::put('admin/{user}/attach',[UserController::class,'attach'])->name('user.role.attach');
        Route::delete('admin/{user}/detach',[UserController::class,'detach'])->name('user.role.detach');
    });

Route::middleware('can:view,user')->group(function(){

    Route::get('/admin/profile/{user}',[UserController::class,'show'])->name('admin.profile');


});
Route::put('/admin/profile/update/{user}',[UserController::class,'update'])->can('update','user')->name('admin.profile.update');




Route::middleware('roleAuthenticate:admin')->group(function(){
    Route::get('/roles',[RoleController::class,'index'])->name('roles.index');
Route::post('/roles/create',[RoleController::class,'store'])->name('role.create');
Route::delete('/roles/{role}/destroy',[RoleController::class,'destroy'])->name('role.destroy');
Route::get('/roles/{role}/edit',[RoleController::class,'edit'])->name('role.edit');
Route::put('/roles/{role}/update',[RoleController::class,'update'])->name('role.update');

});


Route::middleware('roleAuthenticate:admin')->group(function(){
    Route::get('/permissions',[PermissionController::class,'index'])->name('permissions.index');
Route::post('/permissions/create',[PermissionController::class,'store'])->name('permission.create');
Route::delete('/permissions/{permission}/destroy',[PermissionController::class,'destroy'])->name('permission.destroy');
Route::get('/permissions/{permission}/edit',[PermissionController::class,'edit'])->name('permission.edit');
Route::put('/permissions/{permission}/update',[PermissionController::class,'update'])->name('permission.update');

Route::put('/roles/{role}/permission/attach',[RoleController::class,'attach'])->name('role.permission.attach');
Route::delete('/roles/{role}/permission/detach',[RoleController::class,'detach'])->name('role.permission.detach');

});







    