<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\aturanController;
use App\Http\Controllers\aturanPinjamanController;
use App\Http\Controllers\BungaController;
use App\Http\Controllers\bungaPinjamanController;
use App\Http\Controllers\cicilanController;
use App\Http\Controllers\iuranController;
use App\Http\Controllers\pinjamanController;
use App\Http\Controllers\SHUController;
use App\Http\Controllers\simpananController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', function () {
    return redirect('/login');
});
Auth::routes();
Route::get('/index', [AdminController::class, 'index'])->name('index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/resetPassword', [SiteController::class, 'resetPassword'])->name('resetPassword');
Route::post('/doResetPassword', [SiteController::class, 'doResetPassword'])->name('doResetPassword');

//admin
Route::prefix('admin')->middleware(['role:0'])->group(function(){
    Route::get('/index', [AdminController::class, 'index'])->name('admin_index');

    Route::prefix('user')->group(function(){
        Route::get('/', [AdminController::class, 'index'])->name('user_index');
        Route::post('/', [AdminController::class, 'store'])->name('user_store');
        Route::put('/', [AdminController::class, 'update'])->name('user_update');
        Route::post('/deactivate/{id}', [AdminController::class, 'deactivate'])->name('user_deactivate');
        Route::post('/activate/{id}', [AdminController::class, 'activate'])->name('user_activate');
    });
});

Route::prefix('user')->middleware(['role:1'])->group(function(){
    Route::get('/index', [UserController::class, 'index']);
});
