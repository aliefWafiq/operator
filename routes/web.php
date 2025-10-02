<?php

use App\Http\Controllers\antreanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\operatorController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', [operatorController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/listOperator', [operatorController::class, 'listOperator'])->name('listOperator')->middleware('auth');
Route::get('/createOperator', [operatorController::class, 'createOperator'])->name('createOperator')->middleware('auth');
Route::get('/', [operatorController::class, 'loginView'])->name('login');

Route::post('/dashboard/panggil-berikutnya', [antreanController::class, 'panggilAntrean']);
Route::post('/dashboard/panggil-sebelumnya', [antreanController::class, 'panggilAntreanSebelumnya']);
Route::post('/store/operator', [operatorController::class, 'storeOperator']);
Route::post('loginAction', [operatorController::class, 'login']);

Route::get('actionLogout', [operatorController::class, 'actionlogout'])->name('actionLogout')->middleware('auth');
