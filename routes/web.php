<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\JadwalDetailController;
use App\Http\Controllers\JadwalAutomationController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\GradingController;
use App\Http\Controllers\HomeController;
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
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/reset-password', [SiteController::class, 'resetPassword'])->name('resetPassword');
Route::post('/do-reset-password', [SiteController::class, 'doResetPassword'])->name('doResetPassword');

Route::prefix('admin')->middleware(['role:0'])->group(function(){
    Route::get('/', function () {
        return redirect('/dashboard');
    })->name('admin.dashboard');

    Route::prefix('volunteers')->group(function(){
        Route::get('/', [AdminController::class, 'index'])->name('volunteers.index');
        Route::post('/', [AdminController::class, 'store'])->name('volunteeers.store');
        Route::put('/', [AdminController::class, 'update'])->name('volunteeers.update');

        Route::post('/activate/{id}', [AdminController::class, 'activate'])->name('volunteeers.activate');
        Route::post('/deactivate/{id}', [AdminController::class, 'deactivate'])->name('volunteeers.deactivate');

        Route::post('/excel-store', [AdminController::class, 'excelStore'])->name('volunteers.excel_store');
    });

    Route::prefix('cabang')->group(function(){
        Route::get('/', [CabangController::class, 'index'])->name('cabang.index');
        Route::post('/', [CabangController::class, 'store'])->name('cabang.store');
        Route::put('/', [CabangController::class, 'update'])->name('cabang.update');

        Route::post('/activate/{id}', [CabangController::class, 'activate'])->name('cabang.activate');
        Route::post('/deactivate/{id}', [CabangController::class, 'deactivate'])->name('cabang.deactivate');
    });

    Route::prefix('tag')->group(function(){
        Route::get('/', [TagController::class, 'index'])->name('tag.index');
        Route::post('/', [TagController::class, 'store'])->name('tag.store');
        Route::put('/', [TagController::class, 'update'])->name('tag.update');

        Route::post('/activate/{id}', [TagController::class, 'activate'])->name('tag.activate');
        Route::post('/deactivate/{id}', [TagController::class, 'deactivate'])->name('tag.deactivate');
    });

    Route::prefix('bagian')->group(function(){
        Route::get('/', [BagianController::class, 'index'])->name('bagian.index');
        Route::post('/', [BagianController::class, 'store'])->name('bagian.store');
        Route::put('/', [BagianController::class, 'update'])->name('bagian.update');

        Route::post('/activate/{id}', [BagianController::class, 'activate'])->name('bagian.activate');
        Route::post('/deactivate/{id}', [BagianController::class, 'deactivate'])->name('bagian.deactivate');
    });

    Route::prefix('mapping')->group(function(){
        Route::get('/', [MappingController::class, 'index'])->name('mapping.index');
        Route::post('/', [MappingController::class, 'store'])->name('mapping.store');
        Route::put('/', [MappingController::class, 'update'])->name('mapping.update');
        
        Route::post('/activate/{id}', [MappingController::class, 'activate'])->name('mapping.activate');
        Route::post('/deactivate/{id}', [MappingController::class, 'deactivate'])->name('mapping.deactivate');
    });

    Route::prefix('jadwal_ibadah')->group(function(){
        Route::get('/', [JadwalIbadahController::class, 'index'])->name('jadwal_ibadah.index');
        Route::post('/', [JadwalIbadahController::class, 'store'])->name('jadwal_ibadah.store');
        Route::put('/', [JadwalIbadahController::class, 'update'])->name('jadwal_ibadah.update');

        Route::post('/activate/{id}', [JadwalIbadahController::class, 'activate'])->name('jadwal_ibadah.activate');
        Route::post('/deactivate/{id}', [JadwalIbadahController::class, 'deactivate'])->name('jadwal_ibadah.deactivate');
    });

    Route::prefix('tim_pelayanan')->group(function(){
        Route::get('/', [TimPelayananController::class, 'index'])->name('tim_pelayanan.index');
        Route::post('/', [TimPelayananController::class, 'store'])->name('tim_pelayanan.store');

        Route::prefix('member')->group(function(){
            Route::post('/', [TimPelayananController::class, 'storeMember'])->name('tim_pelayanan.member.store');
            Route::put('/', [TimPelayananController::class, 'updateMember'])->name('tim_pelayanan.member.update');
        });
        
        Route::prefix('tim')->group(function(){
            Route::put('/', [TimPelayananController::class, 'updateTim'])->name('tim_pelayanan.tim.update');
        });

        Route::post('/activate/{id}', [TimPelayananController::class, 'activate'])->name('tim_pelayanan.activate');
        Route::delete('/deactivate/{id}/{id_user}', [TimPelayananController::class, 'deactivate'])->name('tim_pelayanan.deactivate');
    });

    Route::prefix('grading')->group(function(){
        Route::get('/', [GradingController::class, 'index'])->name('grading.index');
        Route::put('/', [GradingController::class, 'update'])->name('grading.update');
    });

    Route::prefix('jadwal')->group(function(){
        Route::get('/', [JadwalController::class, 'index'])->name('jadwal.index');
        Route::post('/', [JadwalController::class, 'store'])->name('jadwal.store');
        Route::put('/', [JadwalController::class, 'update'])->name('jadwal.update');

        Route::post('/activate/{id}', [JadwalController::class, 'activate'])->name('jadwal.activate');
        Route::post('/deactivate/{id}', [JadwalController::class, 'deactivate'])->name('jadwal.deactivate');

        Route::get('/download', [JadwalController::class, 'download'])->name('jadwal.download');

        Route::prefix('detail')->group(function(){
            Route::get('/{id}', [JadwalDetailController::class, 'index'])->name('jadwal_detail.index');
            Route::post('/', [JadwalDetailController::class, 'store'])->name('jadwal_detail.store');
            Route::put('/', [JadwalDetailController::class, 'update'])->name('jadwal_detail.update');
            
            // Route::post('/activate/{id}', [JadwalDetailController::class, 'activate'])->name('jadwal_detail.activate');
            // Route::post('/deactivate/{id}', [JadwalDetailController::class, 'deactivate'])->name('jadwal_detail.deactivate');
            
            Route::post('/delete/{id}', [JadwalDetailController::class, 'delete'])->name('jadwal_detail.delete');

            Route::post('/automation', [JadwalAutomationController::class, 'automation'])->name('jadwal_detail.automation');
        });
    });
});

Route::prefix('volunteer')->middleware(['role:3'])->group(function(){
    Route::get('/', function () {
        return redirect('/dashboard');
    })->name('volunteer.index');

    Route::prefix('schedule')->group(function(){
        Route::get('/', [UserController::class, 'volunteerScheduleIndex'])->name('volunteer.schedule.index');
        Route::get('/detail/{id}', [VolunteerController::class, 'detail'])->name('volunteer.schedule.detail');
    });
});

Route::prefix('pic')->middleware(['role:2'])->group(function(){
    Route::get('/', [UserController::class, 'picIndex'])->name('pic.index');
    Route::get('/detail/{id}', [PicController::class, 'detail'])->name('pic.detail');
});

Route::prefix('servo')->middleware(['role:1'])->group(function(){
    Route::get('/', [UserController::class, 'servoIndex'])->name('servo.index');
});