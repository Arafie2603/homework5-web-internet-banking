<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PagesController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Routing tanpa parameter
// Route::get('hello-word', function() {
//     return '<h1>Sasa</h1>';
// });

// Routing dengan parameter
// Route::get('my-name/{name}', function($name) {
//     return 'My Name Is '. $name;
// });

// Routing dengan controller

Route::group(['middleware' => 'NoAuth'], function() {
    Route::post('/', [LoginController::class, 'login']);
    Route::get('/', [LoginController::class, 'index'])->name('login.index');
    
});


Route::group(['middleware' => 'auth', 'checkaccess'], function() {
    Route::get('/dashboard', [PagesController::class, 'index'])->name('pages.index');
    Route::get('/profile', [LoginController::class, 'profile'])->name('profile');
    Route::put('update_profile', [LoginController::class, 'update_profile']);
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});


