<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('awal.home');
});

Route::get('/login', function () {
    return view('login.admin.login');
});
Route::get('/login/resepsionis', function () {
    return view('login.admin.resepsionis.login');
});
Route::get('/register/resepsionis', function () {
    return view('login.admin.resepsionis.register');
});

Route::get('/about', function () {
    return view('awal.about');
});

Route::get('/portofolio', function () {
    return view('awal.portofolio');
});

Route::get('/contact', function () {
    return view('awal.contact');
});

Route::get('/service', function () {
    return view('awal.service');
});


Route::get('/admin123', function () {
    return view('login.admin.admin');
});
