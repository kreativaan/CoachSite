<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', [PageController::class, 'about']);

Route::get('/trainer', [PageController::class, 'trainer']);
Route::post('trainer-profile', [PageController::class, 'saveTrainerProfile']);
