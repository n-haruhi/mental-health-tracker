<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\RecordController;

Route::middleware('auth')->group(function () {
    Route::resource('records', RecordController::class);
});