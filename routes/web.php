<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\guruController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\RaporController;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\angkatanController;
use App\Http\Controllers\dataMapelController;
use App\Http\Controllers\nilaiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and assigned to the "web" middleware group.
| Make something great!
|
*/

// Landing Page
Route::view('/', 'landingpage');



// Role admin
Route::middleware(['authenticate', 'role:admin'])->group(function ()
{
    Route::get('/admin', [adminController::class, 'index'])->name('admin');
    Route::resource('/data-siswa', siswaController::class);
    Route::resource('/data-guru', guruController::class);
    Route::resource('/data-mapel', dataMapelController::class);
    Route::resource('/data-nilai', nilaiController::class);
    Route::resource('/data-angkatan', angkatanController::class);
    Route::get('/search-siswa', [siswaController::class, 'searching'])->name('searching_siswa');
    Route::get('/search-guru', [guruController::class, 'searching'])->name('searching_guru');
    Route::get('/search-mapel', [dataMapelController::class, 'searching'])->name('searching_mapel');
    Route::get('/search-angkatan', [angkatanController::class, 'searching'])->name('searching_angkatan');
    Route::get('/search-nilai', [nilaiController::class, 'searching'])->name('searching_nilai');
    Route::get('/rapor-admin', [RaporController::class, 'raporAdmin'])->name('rapor_admin');
    Route::get('/rapor-search-admin', [RaporController::class, 'searchingAdmin'])->name('rapor_searching');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('done_regis');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Role siswa
Route::get('/mapel', [MapelController::class, 'index'])->name('mapel.index');
Route::get('/mapel-show/{id}', [MapelController::class, 'show'])->name('mapel.show');
Route::middleware(['authenticate', 'role:siswa|admin'])->group(function ()
{
    Route::get('/account-settings', [AccountSettingsController::class, 'index'])->name('account.settings');
    Route::post('/update-account', [AccountSettingsController::class, 'update'])->name('siswa_update');
    Route::get('/rapor', [RaporController::class, 'index'])->name('rapor.index');
    Route::get('/rapor-search', [RaporController::class, 'searching'])->name('searching_rapor');
    Route::get('/get-angkatan-nilai/{angkatanId}', [RaporController::class, 'getAngkatanNilai']);
});

