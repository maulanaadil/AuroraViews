<?php

use App\Http\Controllers\api\AnomalyReportController;
use App\Http\Controllers\api\AuthenticationController;
use App\Http\Controllers\Api\AuthorizationController;
use App\Http\Controllers\Api\BacaMeterController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\OfficerController;
use App\Http\Controllers\Api\PemetaanPetugasController;
use App\Http\Controllers\Api\ReasonController;
use App\Http\Controllers\api\RecordAnalyticsController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
], function ($router) {
    Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthenticationController::class, 'login']);
        Route::post('/register', [AuthenticationController::class, 'register']);

        Route::middleware('jwt.verify')->group(function () {
            Route::post('/logout', [AuthenticationController::class, 'logout']);
        });
    });

    Route::middleware('jwt.verify')->group(function () {
        Route::prefix('petugas')->group(function () {
            Route::get('/', [OfficerController::class, 'getAllOfficer']);
            Route::get('/{id}', [OfficerController::class, 'getOfficerById']);
            Route::post('/add', [OfficerController::class, 'insertOfficer']);
            Route::post('/{id}/update', [OfficerController::class, 'updateOfficer']);
            Route::delete('/{id}', [OfficerController::class, 'deleteOfficer']);
        });

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'getAllUsers']);
            Route::get('/{id}', [UserController::class, 'getUserById']);
            Route::post('/add', [UserController::class, 'insertUser']);
            Route::delete('/{id}', [UserController::class, 'deleteUser']);
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
            Route::get('/analytics', [DashboardController::class, 'getAnalyticsOfficers']);
            Route::get('/analytics_price', [DashboardController::class, 'getAnalyticsCosts']);
            Route::get('/analytics_pencatatan', [DashboardController::class, 'getAnalyticsRecords']);
        });

        Route::prefix('baca_meter')->group(function () {
            Route::get('/', [BacaMeterController::class, 'index']);
            Route::get('/search', [BacaMeterController::class, 'cariDataBacaMeter']);
            Route::get('/info_pelanggan', [BacaMeterController::class, 'divinfopelangganAction']);
            Route::get('/longlat_pelanggan', [BacaMeterController::class, 'divmapAction']);
        });

        Route::prefix('laporan_anomali')->group(function () {
            Route::get('/export_laporan_selisih_tgl', [AnomalyReportController::class, 'getExportDateDiffReport']);
            Route::get('/export_laporan_pemakaian', [AnomalyReportController::class, 'getExportWaterUsage']);
            Route::get('/export_laporan_pemakaian_sama', [AnomalyReportController::class, 'getExportEqualWaterUsage']);
            Route::get('/export_laporan_lebih_tgl', [AnomalyReportController::class, 'getExportOfMoreWaterUsage']);
        });

        Route::prefix('otorisasi')->group(function () {
            Route::get('/', [AuthorizationController::class, 'getAllAuthorization']);
            Route::post('/add', [AuthorizationController::class, 'insertAuthorization']);
            Route::delete('/{id}', [AuthorizationController::class, 'deleteAuthorization']);
        });

        Route::prefix('pencatatan')->group(function () {
            Route::get('/record', [RecordAnalyticsController::class, 'getRecordProgress']);
            Route::get('/office', [RecordAnalyticsController::class, 'getOfficeProgress']);
        });
    });
});
