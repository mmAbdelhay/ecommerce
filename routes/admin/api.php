<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('categories', \App\Http\Controllers\Api\V1\Admin\CategoryController::class);
Route::apiResource('products', \App\Http\Controllers\Api\V1\Admin\ProductController::class);
