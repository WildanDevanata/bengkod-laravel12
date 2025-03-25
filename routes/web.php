<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;

Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');



Route::get('/', function () {
    return view('welcome');
});

Route::prefix('dokter')->group(function () {
    Route::get('/', function () {
        return view('dokter.dashboard');
    });
});

Route::prefix('pasien')->group(function () {
    Route::get('/dashboard', function () { // Ubah '/' menjadi '/dashboard'
        return view('pasien.dashboard');
    });
});
