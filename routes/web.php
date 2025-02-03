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