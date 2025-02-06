<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.home', [
        'title' => 'Home'
    ]);
});

Route::get('/tentang-kami', function () {
    return view('about.about', [
        'title' => 'Tentang Kami'
    ]);
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('dashboard', function () {
    return view('dashboards.dashboard');
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