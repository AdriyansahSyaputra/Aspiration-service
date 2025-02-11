<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\MyReportController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AspirationController;


// Route for home page
Route::controller(AspirationController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::post('/', 'store')->name('aspiration.store')->middleware('auth');
});

// Route for explore page
Route::controller(ExploreController::class)->group(function () {
    Route::get('/jelajah', 'index')->name('explore');
    Route::get('/jelajah/filter', 'filter')->name('explore.filter');
    Route::get('/jelajah', 'search')->name('explore.search');
});

// Route for tentang kami
Route::get('/tentang-kami', function () {
    return view('about.about', [
        'title' => 'Tentang Kami'
    ]);
});

// Route for laporan saya
Route::get('/laporan-saya', [MyReportController::class, 'index'])->middleware(['auth', 'user']);

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

// Route for dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'admin'])->name('dashboard');

// Route for reports page
Route::middleware(['auth', 'admin'])->controller(ReportController::class)->group(function () {
    Route::get('/dashboard/reports', 'index')->name('reports');
    Route::delete('/dashboard/report/{id}', 'destroy')->name('report.destroy');
    Route::get('/dashboard/report/detail/{report:slug}', 'show')->name('reports.show');

    // untuk memberikan tanggapan laporan
    Route::post('/dashboard/report/{report:slug}/reply', 'store')->name('reports.store');

    // untuk mengubah status laporan
    Route::put('/dashboard/report/{id}', 'update')->name('report.update');

    // Route Pencarian
    Route::get('/dashboard/report', 'search')->name('reports.search');
    
    // Route filter status
    Route::get('/dashboard/report/filter', 'filter')->name('reports.status');
});

// Route for user page
Route::middleware(['auth', 'admin'])->controller(UserController::class)->group(function () {
    Route::get('/dashboard/users', 'index')->name('users');
    Route::get('/dashboards/user/{user:slug}/reports', 'showReports')->name('users.show');
});
