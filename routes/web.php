<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestTestController;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('rest', RestTestController::class)->names('restTest');
