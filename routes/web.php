<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Bagian\BagianController;
use App\Http\Controllers\Cabang\CabangController;
use App\Http\Controllers\Grading\GradingController;
use App\Http\Controllers\Jadwal\JadwalController;
use App\Http\Controllers\Jadwal\JadwalDetailController;
use App\Http\Controllers\Jadwal\JadwalAutomationController;
use App\Http\Controllers\JadwalIbadah\JadwalIbadahController;
use App\Http\Controllers\Mapping\MappingController;
use App\Http\Controllers\Tag\TagController;
use App\Http\Controllers\TimPelayanan\TimPelayananController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Dump\Pic\PicController;
use App\Http\Controllers\Dump\Volunteer\VolunteerController;
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
Auth::routes();

Route::get('/', function() { return redirect('/login'); });
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('resetPassword');
Route::post('/reset-password', [AuthController::class, 'doResetPassword'])->name('doResetPassword');

Route::prefix('user')->middleware(['role:0'])->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::post('/', [UserController::class, 'store'])->name('user.store');
    Route::put('/', [UserController::class, 'update'])->name('user.update');

    Route::post('/activate/{id}', [UserController::class, 'activate'])->name('user.activate');
    Route::post('/deactivate/{id}', [UserController::class, 'deactivate'])->name('user.deactivate');

    Route::prefix('excel')-> group(function() {
        Route::get('/', [UserController::class, 'excelIndex'])->name('user.excel.index');
        Route::post('/store', [UserController::class, 'excelStore'])->name('user.excel.store');
        Route::post('/download', [UserController::class, 'excelDownload'])->name('user.excel.download');
    });
});

Route::prefix('cabang')->middleware(['role:0'])->group(function(){
    Route::get('/', [CabangController::class, 'index'])->name('cabang.index');
    Route::post('/', [CabangController::class, 'store'])->name('cabang.store');
    Route::put('/', [CabangController::class, 'update'])->name('cabang.update');

    Route::post('/activate/{id}', [CabangController::class, 'activate'])->name('cabang.activate');
    Route::post('/deactivate/{id}', [CabangController::class, 'deactivate'])->name('cabang.deactivate');
});

Route::prefix('tag')->middleware(['role:0'])->group(function(){
    Route::get('/', [TagController::class, 'index'])->name('tag.index');
    Route::post('/', [TagController::class, 'store'])->name('tag.store');
    Route::put('/', [TagController::class, 'update'])->name('tag.update');

    Route::post('/activate/{id}', [TagController::class, 'activate'])->name('tag.activate');
    Route::post('/deactivate/{id}', [TagController::class, 'deactivate'])->name('tag.deactivate');
});

Route::prefix('bagian')->middleware(['role:0'])->group(function(){
    Route::get('/', [BagianController::class, 'index'])->name('bagian.index');
    Route::post('/', [BagianController::class, 'store'])->name('bagian.store');
    Route::put('/', [BagianController::class, 'update'])->name('bagian.update');

    Route::post('/activate/{id}', [BagianController::class, 'activate'])->name('bagian.activate');
    Route::post('/deactivate/{id}', [BagianController::class, 'deactivate'])->name('bagian.deactivate');
});

Route::prefix('mapping')->middleware(['role:0'])->group(function(){
    Route::get('/', [MappingController::class, 'index'])->name('mapping.index');
    Route::post('/', [MappingController::class, 'store'])->name('mapping.store');
    Route::put('/', [MappingController::class, 'update'])->name('mapping.update');
    
    Route::post('/activate/{id}', [MappingController::class, 'activate'])->name('mapping.activate');
    Route::post('/deactivate/{id}', [MappingController::class, 'deactivate'])->name('mapping.deactivate');
});

Route::prefix('jadwal_ibadah')->middleware(['role:0'])->group(function(){
    Route::get('/', [JadwalIbadahController::class, 'index'])->name('jadwal_ibadah.index');
    Route::post('/', [JadwalIbadahController::class, 'store'])->name('jadwal_ibadah.store');
    Route::put('/', [JadwalIbadahController::class, 'update'])->name('jadwal_ibadah.update');

    Route::post('/activate/{id}', [JadwalIbadahController::class, 'activate'])->name('jadwal_ibadah.activate');
    Route::post('/deactivate/{id}', [JadwalIbadahController::class, 'deactivate'])->name('jadwal_ibadah.deactivate');
});

Route::prefix('tim_pelayanan')->middleware(['role:0'])->group(function(){
    Route::get('/', [TimPelayananController::class, 'index'])->name('tim_pelayanan.index');
    Route::post('/', [TimPelayananController::class, 'storeTim'])->name('tim_pelayanan.store');
    Route::put('/', [TimPelayananController::class, 'updateTim'])->name('tim_pelayanan.tim.update');
    
    Route::post('/activate/{id}', [TimPelayananController::class, 'activate'])->name('tim_pelayanan.activate');
    Route::post('/deactivate/{id}', [TimPelayananController::class, 'deactivate'])->name('tim_pelayanan.deactivate');

    Route::prefix('member')->group(function(){
        Route::post('/', [TimPelayananController::class, 'storeMember'])->name('tim_pelayanan.member.store');
        Route::put('/', [TimPelayananController::class, 'updateMember'])->name('tim_pelayanan.member.update');
        Route::delete('/{id}/{id_user}', [TimPelayananController::class, 'removeMember'])->name('tim_pelayanan.member.remove');
    });
});

Route::prefix('grading')->middleware(['role:0'])->group(function(){
    Route::get('/', [GradingController::class, 'index'])->name('grading.index');
    Route::post('/', [GradingController::class, 'store'])->name('grading.store');
    Route::put('/', [GradingController::class, 'update'])->name('grading.update');
});

Route::prefix('jadwal')->middleware(['role:0'])->group(function(){
    Route::get('/', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::post('/', [JadwalController::class, 'store'])->name('jadwal.store');
    Route::put('/', [JadwalController::class, 'update'])->name('jadwal.update');

    Route::post('/activate/{id}', [JadwalController::class, 'activate'])->name('jadwal.activate');
    Route::post('/deactivate/{id}', [JadwalController::class, 'deactivate'])->name('jadwal.deactivate');

    Route::prefix('excel')->group(function(){
        Route::get('/', [JadwalController::class, 'excelIndex'])->name('jadwal.excel.index');
        Route::post('/download', [JadwalController::class, 'downloadExcel'])->name('jadwal.excel.download');
    });

    Route::prefix('detail')->group(function(){
        Route::get('/{id}', [JadwalDetailController::class, 'index'])->name('jadwal_detail.index');
        Route::post('/', [JadwalDetailController::class, 'store'])->name('jadwal_detail.store');
        Route::put('/', [JadwalDetailController::class, 'update'])->name('jadwal_detail.update');
        
        Route::post('/remove/{id}', [JadwalDetailController::class, 'remove'])->name('jadwal_detail.remove');
        // Route::post('/activate/{id}', [JadwalDetailController::class, 'activate'])->name('jadwal_detail.activate');
        // Route::post('/deactivate/{id}', [JadwalDetailController::class, 'deactivate'])->name('jadwal_detail.deactivate');
        
        Route::post('/automation', [JadwalAutomationController::class, 'automation'])->name('jadwal_detail.automation');
    });
});

// Route::prefix('schedule')->middleware(['role:3'])->group(function(){
//     Route::get('/', [VolunteerController::class, 'index'])->name('volunteer.schedule.index');
//     Route::get('/detail/{id}', [VolunteerController::class, 'detail'])->name('volunteer.schedule.detail');
// });

// Route::prefix('volunteer')->group(function(){
//     Route::get('/', function () {
//         return redirect('/dashboard');
//     })->name('volunteer.index');
// });

// Route::prefix('pic')->middleware(['role:2'])->group(function(){
//     Route::get('/', [PicController::class, 'index'])->name('pic.index');
//     Route::get('/detail/{id}', [PicController::class, 'detail'])->name('pic.detail');
// });