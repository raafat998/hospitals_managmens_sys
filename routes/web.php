<?php

use App\Http\Controllers\ColorSchemeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Auth\LoginController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('register2', [\App\Http\Controllers\Auth\RegisterController::class,'registerView'])->name('register2');
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('store_register');

    Route::get('logout', action: [\App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout-page');

});


