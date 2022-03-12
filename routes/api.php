<?php

use Illuminate\Support\Facades\Route;


Route::post('login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'login']);
Route::post('user/register', [\App\Http\Controllers\Api\V1\User\RegisterController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('logout', [\App\Http\Controllers\Api\Auth\LogoutController::class, 'logout']);
});

