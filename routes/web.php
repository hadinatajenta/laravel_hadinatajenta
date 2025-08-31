<?php

use App\Http\Controllers\DataPasienController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RumahSakitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [RumahSakitController::class, 'showDataRs'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/data-rs/store', [RumahSakitController::class, 'storeRs'])->middleware(['auth','verified'])->name('rs.store');
Route::delete('/data-rs/{id}', [RumahSakitController::class, 'deleteRs'])->middleware(['auth','verified'])->name('rs.delete');
Route::get('/data-rs/search', [RumahSakitController::class, 'search'])->name('rs.search');


Route::get('/data-pasien', [DataPasienController::class, 'index'])->middleware(['auth', 'verified'])->name('pasien.index');
Route::post('/data-pasien/store', [DataPasienController::class, 'store'])->middleware(['auth', 'verified'])->name('pasien.store');
Route::get('/data-pasien/filter', [DataPasienController::class, 'filter'])->middleware(['auth', 'verified'])->name('pasien.filter');
Route::delete('/data-pasien/{id}', [DataPasienController::class, 'destroy'])->middleware(['auth', 'verified'])->name('pasien.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
