<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function(){
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
});

Route::group(['middleware' => 'auth'], function(){

    Route::apiResources([
        'companies' => \App\Http\Controllers\CompanyController::class,
        'employees' => \App\Http\Controllers\EmployeeController::class
    ]);
});
