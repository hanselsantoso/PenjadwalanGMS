<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\JadwalDetailController;
use App\Http\Controllers\JadwalAutomationController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\GradingController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JadwalIbadahController;
use App\Http\Controllers\MappingController;
use App\Http\Controllers\PicController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TimPelayananController;
use App\Http\Controllers\VolunteerController;
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
Route::get('/reset-password', [SiteController::class, 'resetPassword'])->name('resetPassword');
Route::post('/doResetPassword', [SiteController::class, 'doResetPassword'])->name('doResetPassword');

//admin
Route::prefix('admin')->middleware(['role:0'])->group(function(){
    Route::get('/index', [AdminController::class, 'index'])->name('admin_index');

    Route::prefix('user')->group(function(){
        Route::get('/', [AdminController::class, 'userManagement'])->name('user_index');
        Route::post('/', [AdminController::class, 'store'])->name('user_store');
        Route::put('/', [AdminController::class, 'update'])->name('user_update');
        Route::post('/deactivate/{id}', [AdminController::class, 'deactivate'])->name('user_deactivate');
        Route::post('/activate/{id}', [AdminController::class, 'activate'])->name('user_activate');

        Route::post('/users/excel-store', [AdminController::class, 'excel_store'])->name('user.excel_store');
    });

    Route::prefix('cabang')->group(function(){
        Route::get('/', [CabangController::class, 'cabang'])->name('cabang_index');
        Route::post('/', [CabangController::class, 'store'])->name('cabang_store');
        Route::put('/', [CabangController::class, 'update'])->name('cabang_update');
        Route::post('/deactivate/{id}', [CabangController::class, 'deactivate'])->name('cabang_deactivate');
        Route::post('/activate/{id}', [CabangController::class, 'activate'])->name('cabang_activate');
    });

    Route::prefix('tag')->group(function(){
        Route::get('/', [TagController::class, 'tag'])->name('tag_index');
        Route::post('/', [TagController::class, 'store'])->name('tag_store');
        Route::put('/', [TagController::class, 'update'])->name('tag_update');
        Route::post('/deactivate/{id}', [TagController::class, 'deactivate'])->name('tag_deactivate');
        Route::post('/activate/{id}', [TagController::class, 'activate'])->name('tag_activate');
    });

    Route::prefix('mapping')->group(function(){
        Route::get('/', [MappingController::class, 'mapping'])->name('mapping_index');
        Route::post('/', [MappingController::class, 'store'])->name('mapping_store');
        Route::put('/', [MappingController::class, 'update'])->name('mapping_update');
        Route::post('/deactivate/{id}', [MappingController::class, 'deactivate'])->name('mapping_deactivate');
        Route::post('/activate/{id}', [MappingController::class, 'activate'])->name('mapping_activate');
    });

    Route::prefix('jadwal_ibadah')->group(function(){
        Route::get('/', [JadwalIbadahController::class, 'jadwalIbadah'])->name('jadwal_ibadah_index');
        Route::post('/', [JadwalIbadahController::class, 'store'])->name('jadwal_ibadah_store');
        Route::put('/', [JadwalIbadahController::class, 'update'])->name('jadwal_ibadah_update');
        Route::post('/deactivate/{id}', [JadwalIbadahController::class, 'deactivate'])->name('jadwal_ibadah_deactivate');
        Route::post('/activate/{id}', [JadwalIbadahController::class, 'activate'])->name('jadwal_ibadah_activate');
    });


    Route::prefix('bagian')->group(function(){
        Route::get('/', [BagianController::class, 'bagian'])->name('bagian_index');
        Route::post('/', [BagianController::class, 'store'])->name('bagian_store');
        Route::put('/', [BagianController::class, 'update'])->name('bagian_update');
        Route::post('/deactivate/{id}', [BagianController::class, 'deactivate'])->name('bagian_deactivate');
        Route::post('/activate/{id}', [BagianController::class, 'activate'])->name('bagian_activate');
    });

    Route::prefix('grading')->group(function(){
        Route::get('/', [GradingController::class, 'grading'])->name('grading_index');
        Route::put('/', [GradingController::class, 'update'])->name('grading_update');
    });

    Route::prefix('tim_pelayanan')->group(function(){
        Route::get('/', [TimPelayananController::class, 'tim'])->name('tim_index');
        Route::post('/', [TimPelayananController::class, 'store'])->name('tim_store');
        Route::post('/member', [TimPelayananController::class, 'store_member'])->name('tim_store_member');
        Route::put('/updateTim', [TimPelayananController::class, 'updateTim'])->name('tim_update_tim');
        Route::put('/', [TimPelayananController::class, 'updateMember'])->name('tim_update');
        Route::delete('/deactivate/{id}/{id_user}', [TimPelayananController::class, 'deactivate'])->name('tim_deactivate');
        Route::post('/activate/{id}', [TimPelayananController::class, 'activate'])->name('tim_activate');
    });

    Route::prefix('jadwal')->group(function(){
        Route::get('/', [JadwalController::class, 'jadwal'])->name('jadwal_index');
        Route::post('/', [JadwalController::class, 'store'])->name('jadwal_store');
        Route::put('/', [JadwalController::class, 'update'])->name('jadwal_update');
        Route::post('/deactivate/{id}', [JadwalController::class, 'deactivate'])->name('jadwal_deactivate');
        Route::post('/activate/{id}', [JadwalController::class, 'activate'])->name('jadwal_activate');
        Route::get('/download', [JadwalController::class, 'downloadSchedule'])->name('jadwal.download');


        Route::prefix('detail')->group(function(){
            Route::get('/{id}', [JadwalDetailController::class, 'jadwal_detail'])->name('jadwal_detail_index');
            Route::post('/', [JadwalDetailController::class, 'store'])->name('jadwal_detail_store');
            Route::put('/', [JadwalDetailController::class, 'update'])->name('jadwal_detail_update');
            Route::post('/delete/{id}', [JadwalDetailController::class, 'delete'])->name('jadwal_detail_delete');
            // Route::post('/deactivate/{id}', [JadwalDetailController::class, 'deactivate'])->name('jadwal_detail_deactivate');
            // Route::post('/activate/{id}', [JadwalDetailController::class, 'activate'])->name('jadwal_detail_activate');
            Route::post('/automation', [JadwalAutomationController::class, 'automation'])->name('jadwal_automation');
        });
    });
});

Route::prefix('servo')->middleware(['role:1'])->group(function(){
    Route::get('/index', [UserController::class, 'servo']);
});

Route::prefix('volunteer')->middleware(['role:3'])->group(function(){
    Route::get('/', function () {
        return redirect('/home');
    });
    Route::get('/schedule', [UserController::class, 'volunteer']);
    Route::get('/schedule/detail/{id}', [VolunteerController::class, 'detail'])->name('volunteer_detail');
});

Route::prefix('pic')->middleware(['role:2'])->group(function(){
    Route::get('/', [UserController::class, 'pic']);
    Route::get('/detail/{id}', [PicController::class, 'detail'])->name('pic_detail');
});
