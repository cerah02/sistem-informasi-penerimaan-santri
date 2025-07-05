<?php

use App\Http\Controllers\AdminNotifikasiController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BantuanController;
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
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\PassingGradeController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TotalHasilController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Route as RoutingRoute;
use Symfony\Component\Routing\Annotation\Route as AnnotationRoute;

Route::resource('santris', SantriController::class);
Route::resource('gurus', GuruController::class);
Route::resource('pendaftarans', PendaftaranController::class);
Route::resource('hasils', HasilController::class);
Route::resource('ujians', UjianController::class);
Route::get('ujians-delete/{id}', [UjianController::class, 'destroy'])->name('ujian.delete');
Route::resource('soals', SoalController::class);
Route::get('soal-create/{id}', [SoalController::class, 'create'])->name('soal.create');
// Route::resource('jawabans', JawabanController::class);
Route::resource('dokumens', DokumenController::class);
Route::resource('ortus', OrtuController::class);
Route::resource('bantuans', BantuanController::class);
Route::resource('kesehatans', KesehatanController::class);
Route::resource('pengumuman', PengumumanController::class);
Route::resource('agendas', AgendaController::class);
Route::get('soal-ujian/{id}', [SoalController::class, 'ujian'])->name('ujian');
Route::get('list-soal', [SoalController::class, 'list_soal'])->name('list_soal');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Tampilkan form pendaftaran santri
Route::get('santri_pendaftaran_view', [PendaftaranController::class, 'santri_pendaftaran_view'])->name('santri_pendaftaran_view');

// Simpan data santri baru
Route::post('pendaftara_santri_simpan', [PendaftaranController::class, 'pendaftara_santri_simpan'])->name('santris.store');

// Update data santri yang sudah pernah diisi
Route::put('pendaftara_santri_update', [PendaftaranController::class, 'pendaftara_santri_simpan'])->name('santris.update');

Route::post('santri_tambah', [SantriController::class, 'tambah'])->name('santris.tambah');

Route::put('santri_ubah', [SantriController::class, 'ubah'])->name('santris.ubah');
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::get('edit-profile', [AuthController::class, 'edit_profile'])->name('edit_profile');
Route::post('update-profile', [AuthController::class, 'update_profile'])->name('update_profile');
Route::get('/ujian/{jenjang}', [UjianController::class, 'index_buat_soal'])->name('ujians.sd');
Route::get('form-buat-soal/{id}', [UjianController::class, 'form_buat_soal'])->name('form_buat_soal');
Route::get('soals_get/{id}', [SoalController::class, 'index'])->name('soals_get');
Route::get('/ujians/create/{jenjang}', [UjianController::class, 'create'])->name('ujians_create');
Route::get('/tampilan-guru', [GuruController::class, 'tampilanGuru'])->name('guru.tampilan');
Route::view('/sejarah', 'sejarah');
Route::view('/visi-misi', 'visi-misi');
Route::view('/beranda ', 'welcome');
Route::view('/jenjang ', 'jenjang');
Route::view('/fasilitas ', 'fasilitas');
Route::get('/kelulusan-info', [PengumumanController::class, 'showKelulusan'])->name('pengumuman.kelulusan');
Route::view('/pakaian-putra ', 'pakaian_putra');
Route::view('/pakaian-putri ', 'pakaian_putri');
Route::view('/kegiatan-harian ', 'kegiatan_harian');
Route::view('/brosur ', 'brosur');

Route::get('/notifikasi/baca-semua', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return back();
})->name('notifikasi.baca-semua')->middleware('auth');

Route::prefix('admin')->group(function () {
    Route::get('notifikasi', [AdminNotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::get('notifikasi/create', [AdminNotifikasiController::class, 'create'])->name('notifikasi.create');
    Route::post('notifikasi', [AdminNotifikasiController::class, 'store'])->name('admin.notifikasi.store');
    Route::delete('/admin/notifikasi/{id}', [AdminNotifikasiController::class, 'destroy'])->name('notifikasi.destroy');
    Route::get('/admin/notifikasi/{id}/edit', [AdminNotifikasiController::class, 'edit'])->name('notifikasi.edit');
    Route::put('/admin/notifikasi/{id}', [AdminNotifikasiController::class, 'update'])->name('notifikasi.update');
});


Route::get('/passing_grade', [PassingGradeController::class, 'index'])->name('passing_grade.index');
Route::get('/passing-grade/{id}/edit', [PassingGradeController::class, 'edit'])->name('passing_grades.edit');
Route::put('/passing-grades/{id}', [PassingGradeController::class, 'update'])->name('passing_grades.update');

Route::post('/soals/update-status/{id}', [SoalController::class, 'updateStatus'])->name('soals.updateStatus');

Route::get('/laporan', [TotalHasilController::class, 'laporan'])->name('laporan');
Route::get('/laporan/pdf', [TotalHasilController::class, 'cetakPdf'])->name('laporan.cetakPdf');

Route::get('admin_pendaftaran_santri_view', [PendaftaranController::class, 'admin_pendaftaran_santri_view'])->name('admin_pendaftaran_santri_view');
Route::post('admin_pendaftaran_santri_simpan', [PendaftaranController::class, 'admin_pendaftaran_santri_simpan'])->name('admin_pendaftaran_santri_simpan');
Route::post('/hapus-jawaban-dari-hasil', [JawabanController::class, 'hapusDariTabelHasil'])->name('hapus.jawaban.dari.hasil');
Route::get('/jawabans', [JawabanController::class, 'index'])->name('jawabans.index');
Route::get('/jawabans/detail', [JawabanController::class, 'detail'])->name('jawabans.detail');
Route::post('/pendaftarans/{id}/update-status', [PendaftaranController::class, 'updateStatus'])->name('pendaftarans.updateStatus');

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

Route::post('submit-ujian', [SoalController::class, 'submitUjian'])->name('submit.ujian');
