<?php

use App\Http\Controllers\KelasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SantriController;
use App\http\controllers\GuruController;
use App\Http\Controllers\JawabanController;
use App\http\controllers\PendaftaranController;
use App\http\controllers\UjianController;
use App\http\controllers\SoalController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\KesehatanController;
use App\Http\Controllers\OrtuController;

Route::resource('santris', SantriController::class);
Route::resource('kelas', KelasController::class);
Route::resource('gurus',GuruController::class);
Route::resource('pendaftarans',PendaftaranController::class);
Route::resource('ujians',UjianController::class);
Route::resource('soals',SoalController::class);
Route::resource('jawabans',JawabanController::class);
Route::resource('dokumens',DokumenController::class);
Route::resource('ortus',OrtuController::class );
Route::resource('kesehatans',KesehatanController::class);
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
