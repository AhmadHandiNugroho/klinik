<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PasienController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\LaporanDaftarController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\LaporanPasienController;
use App\Http\Controllers\Auth\LogoutController;



Route::middleware(['auth'])->group(function(){
    Route::resource('laporan-daftar', LaporanDaftarController::class);
    Route::resource('laporan-pasien', LaporanPasienController::class);
    Route::resource('pasien', PasienController::class);
    Route::resource('daftar', DaftarController::class);
    Route::resource('poli', PoliController::class);
});

Route::get('logout', function(){
    Auth::logout();

    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');