<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Configurations\ConfigurationController;
use App\Http\Controllers\Admin\Configurations\EditConfigurationController;

 //configurations
     Route::group(['prefix' => 'configuration', 'as'=> 'configurations.'], function(){
        Route::resource('/', ConfigurationController::class);
        // edit configurations
        Route::resource('/edit-configurations', EditConfigurationController::class);
     });