<?php

use App\Http\Controllers\DokterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;

Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');



Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');

    Route::get('/periksa', [DokterController::class, 'periksa'])->name('dokter.periksa');

    Route::match(['get', 'post'], '/obat', [DokterController::class, 'obat'])->name('dokter.obat');
    Route::get('/obat/edit/{id}', [DokterController::class, 'editObat'])->name('dokter.obat.edit');
    Route::post('/obat/update/{id}', [DokterController::class, 'updateObat'])->name('dokter.obat.update');
    Route::delete('/obat/delete/{id}', [DokterController::class, 'deleteObat'])->name('dokter.obat.delete');
});

Route::prefix('pasien')->group(function () {
    Route::get('/dashboard', [PasienController::class, 'dashboard'])->name('pasien.dashboard');
    Route::get('/periksa', [PasienController::class, 'periksa'])->name('pasien.periksa');
    Route::post('/periksa', [PasienController::class, 'storePeriksa'])->name('pasien.storePeriksa');
    Route::get('/riwayat', [PasienController::class, 'riwayat'])->name('pasien.riwayat');
    
    // Edit and update routes
    Route::get('/periksa/{id}/edit', [PasienController::class, 'editPeriksa'])->name('pasien.editPeriksa');
    Route::put('/periksa/{id}', [PasienController::class, 'updatePeriksa'])->name('pasien.updatePeriksa');
    
    // Delete route
    Route::delete('/periksa/{id}', [PasienController::class, 'deletePeriksa'])->name('pasien.deletePeriksa');
});
