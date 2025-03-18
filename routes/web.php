<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BantuanController;
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
use App\Http\Controllers\Waktu_ujianController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FasilitasControllers;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Route as RoutingRoute;

Route::resource('santris', SantriController::class);
Route::resource('kelas', KelasController::class);
Route::resource('gurus',GuruController::class);
Route::resource('pendaftarans',PendaftaranController::class);
Route::resource('ujians',UjianController::class);
Route::get('ujians-delete/{id}',[UjianController::class,'destroy'])->name('ujian.delete');
Route::resource('soals',SoalController::class);
Route::get('soal-create/{id}',[SoalController::class,'create'])->name('soal.create');
Route::resource('jawabans',JawabanController::class);
Route::resource('dokumens',DokumenController::class);
Route::resource('ortus',OrtuController::class );
Route::resource('kesehatans',KesehatanController::class);
Route::resource('bantuans',BantuanController::class);
Route::resource('waktu_ujians',Waktu_ujianController::class);
Route::resource('agendas',AgendaController::class);
Route::resource('fasilitas',FasilitasControllers::class);
Route::resource('waktu_ujians',Waktu_ujianController::class);
Route::get('soal-ujian/{id}',[SoalController::class,'ujian'])->name('ujian');
Route::get('list-soal',[SoalController::class,'list_soal'])->name('list_soal');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class,'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class,'registration'])->name('register');
Route::post('post-registration',[AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class,'dashboard'])->name('dashboard');
Route::get('logout', [AuthController::class,'logout'])->name('logout');
Route::get('santri_pendaftaran_view',[PendaftaranController::class,'santri_pendaftaran_view'])->name('santri_pendaftaran_view');
Route::post('pendaftara_santri_simpan',[PendaftaranController::class,'pendaftara_santri_simpan'])->name('pendaftaransantri.simpan');
Route::resource('roles',RoleController::class);
Route::resource('users',UserController::class);
Route::get('edit-profile', [AuthController::class,'edit_profile'])->name('edit_profile');
Route::post('update-profile', [AuthController::class, 'update_profile'])->name('update_profile');
Route::get('/ujian/{jenjang}', [UjianController::class, 'index_buat_soal'])->name('ujians.sd');
Route::get('form-buat-soal/{id}',[UjianController::class,'form_buat_soal'])->name('form_buat_soal');
Route::get('soals_get/{id}',[SoalController::class,'index'])->name('soals_get');
Route::get('/ujians/create/{jenjang}', [UjianController::class, 'create'])->name('ujians_create');
Route::get('/tampilan-guru', [GuruController::class, 'tampilanGuru'])->name('guru.tampilan');
Route::get('/tampilan-fasilitas', [FasilitasControllers::class, 'tampilanfasilitas'])->name('tampilan_fasilitas');



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

Route::post('submit-ujian',[SoalController::class,'submitUjian'])->name('submit.ujian');
