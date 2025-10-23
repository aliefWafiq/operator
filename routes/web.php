<?php

use App\Http\Controllers\antreanController;
use App\Http\Controllers\perkaraController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\operatorController;
use App\Http\Controllers\pengajuan_jam_sidangController;
use Illuminate\Support\Facades\Artisan;

// GET Routes

Route::get('/run-my-secret-seed', function () {
    try {
        // Ini sama seperti menjalankan 'php artisan db:seed'
        Artisan::call('db:seed');
        return '<h2>BERHASIL!</h2> Database seeder telah dijalankan.';
    } catch (\Exception $e) {
        return '<h2>GAGAL!</h2> ' . $e->getMessage();
    }
});

Route::get('/', [operatorController::class, 'loginView'])->name('login');

Route::get('/dashboard', [operatorController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/listOperator', [operatorController::class, 'listOperator'])->name('listOperator')->middleware('auth');
Route::get('/createOperator', [operatorController::class, 'createOperator'])->name('createOperator')->middleware('auth');
Route::get('/pengajuanSidang', [pengajuan_jam_sidangController::class, 'pengajuanJamSidang'])->name('pengajuanSidang')->middleware('auth');;

Route::get('/listPerkara', [perkaraController::class, 'listPerkara'])->name('listPerkara')->middleware('auth');
Route::get('/tambahPerkara', [perkaraController::class, 'tambahPerkara'])->name('tambahPerkara')->middleware('auth');

Route::get('actionLogout', [operatorController::class, 'actionlogout'])->name('actionLogout')->middleware('auth');

// POST Routes

Route::post('/dashboard/panggil-berikutnya', [antreanController::class, 'panggilAntrean']);
Route::post('/dashboard/panggil-lagi', [antreanController::class, 'panggilLagi']);
Route::post('/dashboard/panggil-sebelumnya', [antreanController::class, 'panggilAntreanSebelumnya']);
Route::post('/store/operator', [operatorController::class, 'storeOperator']);
Route::post('loginAction', [operatorController::class, 'login']);
Route::post('/dashboard/antrean/prioritaskan/{id}', [antreanController::class, 'prioritaskan']);

// PUT Routes

Route::put('/terimaPengajuanJam/{pengajuanJamSidangs}', [pengajuan_jam_sidangController::class, 'terimaPengajuanJam']);
Route::put('/tolakPengajuanJam/{pengajuanJamSidangs}', [pengajuan_jam_sidangController::class, 'tolakPengajuanJam']);
