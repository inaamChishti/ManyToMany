<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('roles',[RoleController::class,'index']);
Route::post('role_store',[RoleController::class,'store']);
Route::get('edit_record/{id}',[RoleController::class,'edit']);
Route::post('update_role',[RoleController::class,'update']);
Route::post('assign_role',[RoleController::class,'assign_role']);