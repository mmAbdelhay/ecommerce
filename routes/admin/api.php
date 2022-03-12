<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('categories', \App\Http\Controllers\Api\V1\Admin\CategoryController::class);
