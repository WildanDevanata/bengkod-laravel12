<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;

Route::get('/', fn () => redirect('login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// regis
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');


// Dokter Routes
Route::prefix('dokter')->middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/dashboard', [DokterController::class, 'index'])->name('dokter.dashboard');
    Route::get('/periksa', [DokterController::class, 'periksa'])->name('dokter.periksa');
    Route::match(['get', 'post'], '/obat', [DokterController::class, 'obat'])->name('dokter.obat');
    Route::get('/obat/edit/{id}', [DokterController::class, 'editObat'])->name('dokter.obat.edit');
    Route::post('/obat/update/{id}', [DokterController::class, 'updateObat'])->name('dokter.obat.update');
    Route::delete('/obat/delete/{id}', [DokterController::class, 'deleteObat'])->name('dokter.obat.delete');
    
    // Rute untuk edit dan update periksa
    Route::get('/periksa/{id}/edit', [DokterController::class, 'editPeriksa'])->name('dokter.periksa.edit');
    Route::put('/periksa/{id}', [DokterController::class, 'updatePeriksa'])->name('dokter.periksa.update');
    
    // Rute untuk delete periksa
    Route::delete('/periksa/{id}', [DokterController::class, 'deletePeriksa'])->name('dokter.periksa.delete');
});



// Pasien Routes
Route::prefix('pasien')->middleware(['auth', 'role:pasien'])->group(function () {
    Route::get('/dashboard', [PasienController::class, 'dashboard'])->name('pasien.dashboard');
    Route::get('/periksa', [PasienController::class, 'periksa'])->name('pasien.periksa');
    Route::post('/periksa', [PasienController::class, 'storePeriksa'])->name('pasien.storePeriksa');
    Route::get('/riwayat', [PasienController::class, 'riwayat'])->name('pasien.riwayat');

    Route::get('/periksa/{id}/edit', [PasienController::class, 'editPeriksa'])->name('pasien.editPeriksa');
    Route::put('/periksa/{id}', [PasienController::class, 'updatePeriksa'])->name('pasien.updatePeriksa');
    Route::delete('/periksa/{id}', [PasienController::class, 'deletePeriksa'])->name('pasien.deletePeriksa');
});
