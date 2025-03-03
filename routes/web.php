<?php

use App\Http\Middleware\AlreadyLoggedUserIn;
use App\Http\Middleware\AuthCheckLoginUser;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('auth.login');
});

Broadcast::routes();

Route::get('/auth/login', \App\Components\Auth\Login::class)->name('auth.login')->middleware(AlreadyLoggedUserIn::class);

Route::prefix('app')
    ->middleware(AuthCheckLoginUser::class)
    ->group(function () {
        Route::get('/', \App\Components\App\Home::class)->name('app.home'); // مسیر بدون پارامتر
        Route::get('/{user?}', \App\Components\App\Home::class)->name('app.home'); // پارامتر اختیاری
    });
