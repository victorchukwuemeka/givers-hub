<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\PermissionController;
use App\Http\Controllers\Admin\User\RoleController;
use App\Http\Controllers\Admin\User\UserController;


  // users
Route::resource('/users', UserController::class);
// roles
Route::resource('/roles', RoleController::class);
// permissions
Route::resource('/permissions', PermissionController::class);
