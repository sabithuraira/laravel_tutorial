<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContohController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PaginationController;

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


Route::get('/halo', function () {
    return "Halo semuanya";
});


Route::get('/home', [HomeController::class, 'index']);
Route::get('/home/show_html', [HomeController::class, 'show_html']);
Route::get('/home/belajar_blade', [HomeController::class, 'belajar_blade']);
Route::get('/home/penggunaan_layout', [HomeController::class, 'penggunaan_layout']);

Route::get('/home/contoh', [HomeController::class, 'contoh']);
Route::post('/home/contoh', [HomeController::class, 'contoh_post']);


// Route::get('/contoh', [ContohController::class, 'index']);
// Route::get('/contoh/create', [ContohController::class, 'create']);
// Route::post('/contoh/create', [ContohController::class, 'store']);
Route::resource('contoh', ContohController::class);
Route::resource('pegawai', PegawaiController::class);
Route::post('/pegawai/{id}/riwayat', [PegawaiController::class, 'store_riwayat']);
Route::delete('/pegawai/{id}/{pegawai_id}/riwayat', [PegawaiController::class, 'destroy_riwayat']);
//Route get => pegawai => index
//Route get => pegawai/create => create
//Route post => pegawai => store
//Route get => pegawai/{id} => show
//Route put/patch => pegawai/{id} => update
//Route delete => pegawai/{id} => delete
//Route get => pegawai/{id}/edit => edit

// Route::get('/pagination', [PaginationController::class, 'index']);
// Route::get('/pagination/show_api', [PaginationController::class, 'show_api']);



