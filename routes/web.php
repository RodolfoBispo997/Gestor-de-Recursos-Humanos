<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    //Redirect
    Route::redirect('/', 'home');
    Route::view('/home', 'home')->name('home');
});

//Route::view('/password.request', 'forgot-password');