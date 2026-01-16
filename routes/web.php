<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/potenz', function () {
    return view('potenz');
});

Route::get('/vergleichen', function () {
    return view('vergleichen');
});

Route::get('/stellenwert', function () {
    return view('stellenwert');
});
