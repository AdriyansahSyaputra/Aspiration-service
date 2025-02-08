<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\DashboardController;

Route::get('/tentang-kami', function () {
    return view('about.about', [
        'title' => 'Tentang Kami'
    ]);
});

// Route for register
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'index')->name('register.index');
    Route::post('/register', 'store')->name('register.store');
});

// Route for login
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('login.login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'admin']);


// Route for home page
Route::controller(AspirationController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::post('/', 'store')->name('aspiration.store')->middleware('auth');
});

// Route for reports page
Route::middleware(['auth', 'admin'])->controller(ReportController::class)->group(function () {
    Route::get('/dashboard/reports', 'index')->name('reports');
    Route::delete('/dashboard/report/{id}', 'destroy')->name('report.destroy');
    Route::get('/dashboard/report/detail/{report:slug}', 'show')->name('reports.show');
    Route::put('/dashboard/report/{id}', 'update')->name('report.update');
});

// Route for user page
Route::middleware(['auth', 'admin'])->controller(UserController::class)->group(function () {
    Route::get('/dashboard/users', 'index')->name('users');
    Route::get('/dashboards/user/{user:slug}/reports', 'showReports')->name('users.show');
});
