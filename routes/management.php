<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'manage'], function() {

   Route::get('/statuses', function() {
       return view('status.index');
   })->name('status.index');

   Route::get('/staff', function() {
       return view('staff.index');
   })->name('staff.index');

   Route::get('/users', function() {
       return view('users.index');
   })->name('users.index');


    Route::get('/permissions', function() {
     return view('permissions.index');
    })->name('permissions.index');

    Route::get('/roles', function() {
        return view('roles.index');
       })->name('roles.index');

});

?>
