<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProgramStudiController;



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


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function(){
    Route::get('/', function () {
        return view('home');
    })->name('home');
    Route::controller(MahasiswaController::class)->prefix('nahasiswa')->group(function(){
        Route::get('','index')->name('mahasiswa');
        Route::post('/store','store')->name('mahasiswa.store');
        Route::put('/update{id_mahasiswa}','update')->name('mahasiswa.update');
        Route::delete('/destroy{id_mahasiswa}','destroy')->name('mahasiswa.destroy');
    });
    Route::controller(MatkulController::class)->prefix('matkul')->group(function(){
        Route::get('','index')->name('matkul');
        Route::post('/store','store')->name('matkul.store');
        Route::put('/update{id_matkul}','update')->name('matkul.update');
        Route::delete('/destroy{matkul_id}','destroy')->name('matkul.destroy');
    });
    Route::controller(DosenController::class)->prefix('dosen')->group(function(){
        Route::get('','index')->name('dosen');
        Route::post('/store','store')->name('dosen.store');
        Route::put('/update{id_dosen}','update')->name('dosen.update');
        Route::delete('/destroy{id_dosen}','destroy')->name('dosen.destroy');
    });
    Route::controller(ProgramStudiController::class)->prefix('programstudi')->group(function(){
        Route::get('', 'index')->name('programstudi');
        Route::post('/store', 'store')->name('programstudi.store');
        Route::put('/update/{id_programstudi}', 'update')->name('programstudi.update');
        Route::delete('/destroy/{id_programstudi}', 'destroy')->name('programstudi.destroy');
    });
    Route::controller(NilaiController::class)->prefix('nilai')->group(function(){
        Route::get('', 'index')->name('nilai');
        Route::post('/store', 'store')->name('nilai.store');
        Route::put('/update/{id}', 'update')->name('nilai.update');
        Route::delete('/destroy/{id}', 'destroy')->name('nilai.destroy');
    });
});
