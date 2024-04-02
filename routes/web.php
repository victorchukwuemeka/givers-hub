<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__.'/auth.php';
require __DIR__.'/account.php';

// admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth','admin']], function(){

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard.index');
    Route::get('/profile', [ProfileController::class,'profile'] )->name('profile');
    Route::post('/profile/upadte', [ProfileController::class,'profileUpdate'] )->name('profile.update');

    include base_path('routes/user.php');
    include base_path('routes/configurations.php');

});
