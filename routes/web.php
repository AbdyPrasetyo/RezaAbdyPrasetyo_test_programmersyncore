<?php

use App\Http\Controllers\BiodataController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

Route::get('register', function () {
    return view('auth.register');
});
Route::get('logins', function () {
    return view('auth.login');
});


Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/post', 'registers')->name('registers');
    Route::post('login/proses', 'proses');
    Route::get('logout', 'logout');
});


Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cekUserLogin:1']], function () {


        Route::resource('dashboard', DashboardController::class);
    });
});

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cekUserLogin:2']], function () {

        Route::resource('biodata', BiodataController::class);
    });
});
