<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/role',[RoleController::class,'index'])->name('role.index');
Route::get('/role/create',[RoleController::class,'create'])->name('role.create');
Route::post('/role/store',[RoleController::class,'store'])->name('role.store');
Route::get('/role/edit/{id}',[RoleController::class,'edit'])->name('role.edit');
Route::post('/role/update/{id}',[RoleController::class,'update'])->name('role.update');
Route::get('/role/delete/{id}',[RoleController::class,'destroy'])->name('role.delete');
