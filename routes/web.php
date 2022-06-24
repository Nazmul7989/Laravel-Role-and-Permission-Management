<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Role Route
Route::get('/role',[RoleController::class,'index'])->name('role.index');
Route::get('/role/create',[RoleController::class,'create'])->name('role.create');
Route::post('/role/store',[RoleController::class,'store'])->name('role.store');
Route::get('/role/edit/{id}',[RoleController::class,'edit'])->name('role.edit');
Route::post('/role/update/{id}',[RoleController::class,'update'])->name('role.update');
Route::get('/role/delete/{id}',[RoleController::class,'destroy'])->name('role.delete');


//User Route
Route::get('/users',[UserController::class,'index'])->name('users.index');
Route::get('/users/create',[UserController::class,'create'])->name('users.create');
Route::post('/users/store',[UserController::class,'store'])->name('users.store');
Route::get('/users/edit/{id}',[UserController::class,'edit'])->name('users.edit');
Route::post('/users/update/{id}',[UserController::class,'update'])->name('users.update');
Route::get('/users/delete/{id}',[UserController::class,'destroy'])->name('users.delete');
