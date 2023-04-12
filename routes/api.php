<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\Api\PetugasController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'v1'
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
        });
    });
});