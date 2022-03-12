<?php

use Illuminate\Support\Facades\Route;


Route::post('login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'login']);


