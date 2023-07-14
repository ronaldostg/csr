<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PemohonController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\DB;
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

// Route::get('/', function () {
//    DB::connection()->getPDO();
//    echo \DB::connection()->getDatabaseName();
// });


Route::get('/', [HomeController::class, 'index'])->middleware('cek_login');
// Route::get('/', function(){
//     echo 'test 123';
// });


Auth::routes();

// sidebar
Route::resource('home', \App\Http\Controllers\HomeController::class)->middleware('cek_login');

Route::resource('pemohon', \App\Http\Controllers\PemohonController::class)->middleware('cek_login');
Route::delete('/pemohon/{id}', [App\Http\Controllers\PemohonController::class, 'destroy']);
Route::resource('unit', \App\Http\Controllers\UnitController::class)->middleware('cek_login');
Route::resource('files', \App\Http\Controllers\FilesController::class)->middleware('cek_login');

// Unit
Route::get('unit/create/{id}', [UnitController::class, 'create'])->middleware('cek_login');
Route::get('/show/{id}/edit', [UnitController::class, 'edit'])->middleware('cek_login');
Route::get('edit_dalok/{id}', [UnitController::class, 'edit_dalok'])->middleware('cek_login');
Route::patch('update/{id}', [UnitController::class, 'update']);
Route::delete('hapus_dalok/{id}', [UnitController::class, 'hapus_dalok']);

Route::get('dest', [HomeController::class, 'dest'])->name('dest');

// ajax unit
Route::get('getAlok', [PemohonController::class, 'getAlok']);

// pemohon
Route::patch('/update_pemohon/{id}/update_pemohon', [PemohonController::class, 'update_pemohon']);
Route::get('/proses/{id}/proses', [PemohonController::class, 'proses'])->middleware('cek_login');

// validasi
Route::get('/proses_validasi/{id}/proses_validasi', [PemohonController::class, 'proses_validasi'])->middleware('cek_login');
Route::get('/edit_evaluasi/{id}/edit_evaluasi', [PemohonController::class, 'edit_evaluasi'])->middleware('cek_login');
Route::post('/valid', [PemohonController::class, 'valid'])->name('valid')->middleware('cek_login');
Route::patch('update', [App\Http\Controllers\PemohonController::class, 'update'])->name('update');
Route::patch('/upload_validasi/{id}/upload_validasi', [PemohonController::class, 'upload_validasi']);

// bapi
Route::get('/proses_bapi/{id}/proses_bapi', [PemohonController::class, 'proses_bapi']);
Route::get('/edit_bapi/{id}/edit_bapi', [PemohonController::class, 'edit_bapi']);
Route::post('/bapi', [PemohonController::class, 'bapi'])->name('bapi');
Route::patch('update_bapi', [App\Http\Controllers\PemohonController::class, 'update_bapi'])->name('update_bapi');
Route::patch('/upload_bapi/{id}/upload_bapi', [PemohonController::class, 'upload_bapi']);

// cetak
Route::get('/cetak/{id}/cetak', [PemohonController::class, 'cetak'])->middleware('cek_login');
Route::get('/cetak_sk/{id}/cetak_sk', [PemohonController::class, 'cetak_sk'])->middleware('cek_login');
Route::get('/cetak_skr/{id}/cetak_skr', [PemohonController::class, 'cetak_skr'])->middleware('cek_login');
Route::get('/cetak_k/{id}/cetak_k', [PemohonController::class, 'cetak_k'])->middleware('cek_login');
Route::get('/cetak_bapi/{id}/cetak_bapi', [PemohonController::class, 'cetak_bapi'])->middleware('cek_login');

//upload
Route::patch('/upload_file/{id}/upload_file', [PemohonController::class, 'upload_file']);


// download
Route::get('download_evaluasi/{id}', [FilesController::class, 'download_evaluasi'])->name('files.download_evaluasi');
Route::get('download_bapi/{id}', [FilesController::class, 'download_bapi'])->name('files.download_bapi');
Route::get('download_sk/{id}', [FilesController::class, 'download_sk'])->name('files.download_sk');

Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');

Route::get('download_excel', [LaporanController::class, 'download_excel'])->name('laporan.download');


Route::get('remove_photo', [PemohonController::class, 'remove_file'])->name('laporan.remove');

Route::get('settings',[SettingsController::class, 'index'])->middleware('cek_login');
Route::post('edit-settings',[SettingsController::class, 'edit'])->middleware('cek_login');



// Route::get('/contact-form', [LoginController::class, 'index']);
// Route::post('/captcha-validation', [LoginController::class, 'capthcaFormValidate']);
Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha']);








// Route::get('download_evaluasi', [FilesController::class, 'download_evaluasi']);
// Route::get('download_bapi', [FilesController::class, 'download_bapi']);

// Route::get('/home', function () {
//     $master = DB::table('t_master')
//         ->count();
//     $selesai = DB::table('t_master')
//         ->whereNotNull('file_val')
//         ->count();
//     $belum = DB::table('t_master')
//         ->whereNull('file_val')
//         ->count();
//     $unit = DB::table('t_unit')
//         ->count();
//     return view('home', ['master' => $master, 'unit' => $unit, 'selesai' => $selesai, 'belum' => $belum]);
// })->name('home')->middleware('cek_login');