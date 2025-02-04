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