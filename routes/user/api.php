<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('orders', \App\Http\Controllers\Api\V1\User\OrderController::class)->except('update');
