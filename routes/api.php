<?php

use App\Http\Middleware\DomainRestrictionMiddleware;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->away('https://www.google.com');
});


Route::middleware([DomainRestrictionMiddleware::class])->group(function () {

    Route::apiResource('tasks', App\Http\Controllers\TaskController::class);
    Route::put('tasks/{task}/status', [App\Http\Controllers\TaskController::class, 'updateStatus']);
    Route::delete('tasks/{task}/delete', [App\Http\Controllers\TaskController::class, 'deleteSingleTask']);
});

