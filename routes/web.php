<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    //Redirect
    Route::redirect('/', 'home');
    Route::view('/home', 'home')->name('home');

    //User Profile page
    Route::get('/user/profile', [ProfileController::class, 'index'])->name('user.profile');
    //change password
    Route::post('/user/profile/update-password', [ProfileController::class, 'updatePassword'])->name('user.profile.update-password');
    //Change Perfil Usuário
    Route::post('/user/profile/update-user-data', [ProfileController::class, 'updateUserData'])->name('user.profile.update-user-data');
});

//Route::view('/password.request', 'forgot-password');