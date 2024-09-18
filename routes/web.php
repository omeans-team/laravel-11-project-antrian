<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AntrianController;

Route::get('/dashboard', [AntrianController::class, 'dashboard'])->name('dashboard');
Route::get('/', [AntrianController::class, 'dashboard']);
Route::get('/nomor-antrian', [AntrianController::class, 'nomorAntrian'])->name('nomor-antrian');
Route::get('/panggilan-antrian', [AntrianController::class, 'panggilanAntrian'])->name('panggilan-antrian');
Route::get('/get-no-antrian', [AntrianController::class, 'getNoAntrian'])->name('get_no_antrian');
Route::post('/insert-antrian', [AntrianController::class, 'insertAntrian'])->name('insert_antrian');

Route::get('/antrian', [AntrianController::class, 'index'])->name('antrian');
Route::get('/get_jumlah_antrian', [AntrianController::class, 'getJumlahAntrian'])->name('get_jumlah_antrian');
Route::get('/get_antrian_sekarang', [AntrianController::class, 'getAntrianSekarang'])->name('get_antrian_sekarang');
Route::get('/get_antrian_selanjutnya', [AntrianController::class, 'getAntrianSelanjutnya'])->name('get_antrian_selanjutnya');
Route::get('/get_sisa_antrian', [AntrianController::class, 'getSisaAntrian'])->name('get_sisa_antrian');
Route::get('/get_antrian', [AntrianController::class, 'getAntrian'])->name('get_antrian');
Route::post('/update_antrian', [AntrianController::class, 'updateAntrian'])->name('update_antrian');
