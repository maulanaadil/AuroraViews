<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\Api\AuthorizationController;
use App\Http\Controllers\Api\BacaMeterController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\LaporanAnomaliController;
use App\Http\Controllers\Api\PemetaanPetugasController;
use App\Http\Controllers\Api\PetugasController;
use App\Http\Controllers\Api\ProgressPencatatanMeterController;
use App\Http\Controllers\Api\ProgressPencatatanPetugasController;
use App\Http\Controllers\Api\ReasonController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
], function ($router) {
    Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/refresh', [AuthController::class, 'refresh']);

        Route::middleware('jwt.verify')->group(function () {
            Route::post('/logout', [AuthController::class, 'logout']);
        });
    });

    Route::middleware('jwt.verify')->group(function () {
        Route::prefix('petugas')->group(function () {
            Route::get('/', [PetugasController::class, 'getAllPetugasByName']);
            Route::get('/all', [PetugasController::class, 'getAllPetugas']);
            Route::get('/{id}', [PetugasController::class, 'getPetugasById']);
            Route::post('/add', [PetugasController::class, 'addPetugas']);
            Route::post('/{id}/update', [PetugasController::class, 'updatePetugas']);
            Route::delete('/{id}', [PetugasController::class, 'deletePetugas']);
            Route::post('/bulk_delete', [PetugasController::class, 'deleteBulkPetugas']);
        });

        Route::prefix('users')->group(function () {
            Route::get('/', [UsersController::class, 'getAllUsersByName']);
            Route::get('/all', [UsersController::class, 'getAllUsers']);
            Route::get('/{id}', [UsersController::class, 'getUserById']);
            Route::post('/add', [UsersController::class, 'addUser']);
            Route::post('/{id}/update', [UsersController::class, 'updateUser']);
            Route::delete('/{id}', [UsersController::class, 'deleteUser']);
            Route::post('/bulk_delete', [UsersController::class, 'deleteBulkUser']);
        });

        Route::prefix('pemetaan_petugas')->group(function () {
            Route::get('/select_regional', [PemetaanPetugasController::class, 'getSelectRegional']);
            Route::get('/select_blocks', [PemetaanPetugasController::class, 'getSelectBlocks']);
            Route::get('/area_petugas', [PemetaanPetugasController::class, 'getAreaByPetugasId']);
            Route::get('/data_jalan', [PemetaanPetugasController::class, 'getDataJalan']);
            Route::post('/add', [PemetaanPetugasController::class, 'addPemetaanPetugas']);
            Route::delete('/{id}', [PemetaanPetugasController::class, 'deletePemetaanPetugas']);
        });

        Route::prefix('alasan')->group(function () {
            Route::get('/', [ReasonController::class, 'getAllReason']);
            Route::get('/{id}', [ReasonController::class, 'getReasonById']);
            Route::post('/add', [ReasonController::class, 'insertReason']);
            Route::post('/{id}/update', [ReasonController::class, 'updateReason']);
            Route::delete('/{id}', [ReasonController::class, 'deleteReason']);
        });

        Route::prefix('dashboard')->group(function () {
            Route::get('/analytics', [DashboardController::class, 'getAnalytics']);
            Route::get('/analytics_price', [DashboardController::class, 'getAnalyticCost']);
            Route::get('/analytics_pencatatan', [DashboardController::class, 'getAnalyticsPencatatan']);
        });

        Route::prefix('baca_meter')->group(function () {
            Route::get('/', [BacaMeterController::class, 'index']);
            Route::get('/search', [BacaMeterController::class, 'cariDataBacaMeter']);
            Route::get('/info_pelanggan', [BacaMeterController::class, 'divinfopelangganAction']);
            Route::get('/longlat_pelanggan', [BacaMeterController::class, 'divmapAction']);
        });

        Route::prefix('laporan_anomali')->group(function () {
            Route::get('/export_laporan_selisih_tgl', [LaporanAnomaliController::class, 'exportexcel1Action']);
            Route::get('/export_laporan_pemakaian', [LaporanAnomaliController::class, 'exportexcel1Action2']);
            Route::get('/export_laporan_pemakaian_sama', [LaporanAnomaliController::class, 'exportexcel1Action3']);
            Route::get('/export_laporan_lebih_tgl', [LaporanAnomaliController::class, 'exportexcel1Action4']);
            Route::get('/select_regional', [LaporanAnomaliController::class, 'selectRegionalAction']);
            Route::get('/select_block', [LaporanAnomaliController::class, 'selectBlocksAction']);
        });

        Route::prefix('otorisasi')->group(function () {
            Route::get('/', [AuthorizationController::class, 'getAllAuthorization']);
            Route::post('/add', [AuthorizationController::class, 'insertAuthorization']);
            Route::delete('/{id}', [AuthorizationController::class, 'deleteAuthorization']);
        });

        Route::prefix('progress_pencatatan_meter')->group(function () {
            Route::get('/', [ProgressPencatatanMeterController::class, 'getProgressPercabang']);
        });

        Route::prefix('progress_pencatatan_petugas')->group(function () {
            Route::get('/', [ProgressPencatatanPetugasController::class, 'getProgressPencatatan']);
        });
    });
});
