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

Route::get('/umstellen', function () {
    return view('umstellen');
});

Route::get('/rechnen', function () {
    return view('rechnen');
});

Route::get('/distributiv', function () {
    return view('distributiv');
});

Route::get('/klammern-vereinfachen', function () {
    return view('klammern-vereinfachen');
});

Route::get('/klammern-entfernen', function () {
    return view('klammern-entfernen');
});
