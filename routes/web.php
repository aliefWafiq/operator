<?php

use App\Http\Controllers\antreanController;
use App\Http\Controllers\perkaraController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\operatorController;
use App\Http\Controllers\pengajuan_jam_sidangController;
use App\Models\operators;

// GET Routes

Route::get('/run-direct-logic', function () {
    try {
        $operator = operators::updateOrCreate(
            [
                'email' => 'tes@gmail.com'
            ],
            [
                'namaOperator' => 'tes',
                'password' => '$2y$12$TTkCRi1q.ez5WGPth7gsp.58EmgrVEh7xY6cc.c6JyDqmwnpzqAMK'
            ]
        );

        echo "<h2>BERHASIL EKSEKUSI LANGSUNG!</h2>";
    } catch (\Exception $e) {
        echo "<h2>GAGAL SAAT EKSEKUSI LANGSUNG!</h2>";
    }
});

Route::get('/', [operatorController::class, 'loginView'])->name('login');

Route::get('/dashboard', [operatorController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/listOperator', [operatorController::class, 'listOperator'])->name('listOperator')->middleware('auth');
Route::get('/createOperator', [operatorController::class, 'createOperator'])->name('createOperator')->middleware('auth');
Route::get('/pengajuanSidang', [pengajuan_jam_sidangController::class, 'pengajuanJamSidang'])->name('pengajuanSidang')->middleware('auth');

Route::get('/listPerkara', [perkaraController::class, 'listPerkara'])->name('listPerkara')->middleware('auth');
Route::get('/tambahPerkara', [perkaraController::class, 'tambahPerkara'])->name('tambahPerkara')->middleware('auth');
Route::get('/editPerkara/{id_perkara}', [perkaraController::class, 'editPerkara'])->name('editPerkara')->middleware('auth');

Route::get('actionLogout', [operatorController::class, 'actionlogout'])->name('actionLogout')->middleware('auth');
Route::get('/deletePerkara/{id_perkara}', [perkaraController::class, 'deletePerkara'])->name('deletePerkara')->middleware('auth');

// POST Routes

Route::post('/dashboard/panggil-berikutnya', [antreanController::class, 'panggilAntrean']);
Route::post('/dashboard/panggil-lagi', [antreanController::class, 'panggilLagi']);
Route::post('/dashboard/panggil-sebelumnya', [antreanController::class, 'panggilAntreanSebelumnya']);
Route::post('/store/operator', [operatorController::class, 'storeOperator']);
Route::post('loginAction', [operatorController::class, 'login']);
Route::post('/dashboard/antrean/prioritaskan/{id}', [antreanController::class, 'prioritaskan']);
Route::post('/action/createPerkara', [perkaraController::class, 'createPerkara']);

// PUT Routes

Route::put('/terimaPengajuanJam/{pengajuanJamSidangs}', [pengajuan_jam_sidangController::class, 'terimaPengajuanJam']);
Route::put('/tolakPengajuanJam/{pengajuanJamSidangs}', [pengajuan_jam_sidangController::class, 'tolakPengajuanJam']);
Route::put('/action/updatePerkara/{id_perkara}', [perkaraController::class, 'updatePerkara']);