<?php

use App\Http\Middleware\AdminOnly;
use App\Http\Controllers\NotificationController;

Route::get('/admin', [NotificationController::class, 'index'])
    ->name('notifications.index');

Route::get('/request/{notification:id}', [NotificationController::class, 'show'])
    ->name('notifications.show');

Route::post('/notification', [NotificationController::class, 'store'])
    ->name('notifications.store');

Route::post('/update/notification', [NotificationController::class, 'update'])
    ->name('notifications.update');

?>
