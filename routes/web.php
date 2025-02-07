<?php

use App\Http\Controllers\AspirationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;


Route::get('/tentang-kami', function () {
    return view('about.about', [
        'title' => 'Tentang Kami'
    ]);
});

Route::get('/dashboard/reports', function () {
    return view('dashboards.reports.report');
});

Route::get('/dashboard/report-detail', function () {
    return view('dashboards.reports.report-detail');
});

Route::get('/dashboard/users', function () {
    return view('dashboards.users.users');
});

Route::get('/dashboard/user-report', function () {
    return view('dashboards.users.user-report');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'index')->name('register.index');
    Route::post('/register', 'store')->name('register.store');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('login.login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/dashboard', function () {
    return view('dashboards.dashboard');
})->name('dashboard');

Route::controller(AspirationController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::post('/', 'store')->name('aspiration.store');
});