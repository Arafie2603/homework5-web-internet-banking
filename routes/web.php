<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KategoriProduk;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

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



Route::group(['middleware' => 'NoAuth'], function() {
    Route::post('pendaftaran',[RegisterController::class,'store']);
    Route::get('pendaftaran',[RegisterController::class,'index']);
    
    Route::get('/', [LoginController::class, 'index']);
    Route::post('/daftar', [LoginController::class, 'login']);
    
});

Route::group(['middleware' => ['auth', 'cekleveladmin'], 'prefix' => 'admin'], function(){
    // Route::get('dashboard', 'App\Http\Controllers\DashboardAdminController@index')->name('dashboard');
    Route::resource('dashboard', AdminController::class);
    Route::resource('user', UserController::class);
    // Route::get('user', [AdminController::class, 'userInfo'])->name('user.userInfo');
    Route::resource('produk', ProdukController::class);
    Route::resource('kategori', KategoriController::class);
});

Route::group(['middleware' => 'auth', 'checkaccess'], function() {
    Route::resource('dashboard_user', UserController::class);
    Route::get('/profile', [LoginController::class, 'profile'])->name('profile');

    Route::resource('kategori_produk', KategoriProduk::class);
    Route::get('produk_kategori/{id}', 'App\Http\Controllers\KategoriProduk@show');

    Route::put('update_profile', [LoginController::class, 'update_profile']);
    Route::post('update_profile', [LoginController::class, 'update_profile']);
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});


