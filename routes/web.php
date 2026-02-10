<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\YandexReviewController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return auth()->check()
        ? redirect('/settings')
        : redirect('/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/settings', fn() => Inertia::render('Settings'));
    Route::get('/reviews', fn() => Inertia::render('Reviews'));

    Route::post('/yandex/reviews', YandexReviewController::class);
    Route::post('/logout', [AuthController::class, 'logout']);

});

Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => Inertia::render('Login'))->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

