<?php

use App\Http\Controllers\RequestController;

Route::get('/requests', [RequestController::class, 'index'])
    ->middleware('auth')
    ->name('requests.index');

Route::get('/create-notifications', [RequestController::class, 'create'])
    ->middleware('auth')
    ->name('requests.create');

Route::post('/create-notifications', [RequestController::class, 'store'])
    ->middleware('auth')
    ->name('requests.store');


?>
