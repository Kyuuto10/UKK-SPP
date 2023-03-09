<?php

use App\Http\Controllers\Admin\{PembayaranController, KelasController, SPPController, 
                                SiswaController, PetugasController, HistoryController};
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();


//Route User


Route::group(['middleware' => ['prevent-back-history','auth','user-access:siswa']],function(){
    Route::get('/logout', [LoginController::class,'logout'])->name('logout');
    Route::get('/home/siswa/{nisn}', [App\Http\Controllers\HomeController::class, 'siswa'])->name('siswa');
    
    Route::get('history/siswa', [PembayaranController::class, 'history'])->name('history');
    Route::resource('history', HistoryController::class);
    Route::get('history/export', [HistoryController::class, 'export'])->name('history.export');    
});

//Route Petugas
Route::group(['middleware' => ['prevent-back-history','auth','user-access:petugas']],function(){
    Route::get('/logout', [LoginController::class,'logout'])->name('logout');
    Route::get('/home/petugas', [App\Http\Controllers\HomeController::class, 'petugas'])->name('petugas');
    
    Route::resource('pembayaran', PembayaranController::class);
    Route::get('pembayaran/getData/{nisn}/{berapa}', [PembayaranController::class, 'getData'])->name('pembayaran.getData');
    Route::resource('history', HistoryController::class);
    Route::get('history/export', [HistoryController::class, 'export'])->name('history.export');
    Route::resource('kelas', KelasController::class);
    Route::resource('spp', SPPController::class);
    Route::resource('siswa', SiswaController::class);    
});


//Route Admin

Route::group(['middleware' => ['prevent-back-history','auth','user-access:admin']],function(){
    Route::get('/logout', [LoginController::class,'logout'])->name('logout');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('pembayaran', PembayaranController::class);
    Route::get('pembayaran/getData/{nisn}/{berapa}', [PembayaranController::class, 'getData'])->name('pembayaran.getData');
    Route::resource('history', HistoryController::class);
    Route::get('history/export', [HistoryController::class, 'export'])->name('history.export');
    Route::resource('kelas', KelasController::class);
    Route::resource('spp', SPPController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('petugas', PetugasController::class);
});