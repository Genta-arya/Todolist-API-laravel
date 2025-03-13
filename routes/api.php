<?php

use App\Http\Middleware\DomainRestrictionMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->away('https://www.google.com');
});


Route::middleware([DomainRestrictionMiddleware::class])->group(function () {

    Route::apiResource('tasks', App\Http\Controllers\TaskController::class);
    Route::put('tasks/{task}/status', [App\Http\Controllers\TaskController::class, 'updateStatus']);
    Route::delete('tasks/{task}/delete', [App\Http\Controllers\TaskController::class, 'deleteSingleTask']);
});

