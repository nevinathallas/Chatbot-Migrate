<?php

use App\Http\Controllers\MainDealerController;
use App\Http\Controllers\ModelMotorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\PromoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\BrosurController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('main-dealer', MainDealerController::class);
Route::apiResource('promo', PromoController::class);
// Add nested cabang routes
Route::get('main-dealer/{id}/cabangs', [MainDealerController::class, 'getCabangs']);
Route::post('main-dealer/{id}/cabangs', [MainDealerController::class, 'storeCabang']);
Route::get('main-dealer/{mainId}/cabangs/{cabangId}', [MainDealerController::class, 'showCabang']);
Route::put('main-dealer/{mainId}/cabangs/{cabangId}', [MainDealerController::class, 'updateCabang']);
Route::delete('main-dealer/{mainId}/cabangs/{cabangId}', [MainDealerController::class, 'destroyCabang']);

Route::apiResource('model-motor', ModelMotorController::class);
Route::apiResource('service', ServiceController::class);
Route::apiResource('motor', MotorController::class);
Route::apiResource('harga', HargaController::class);
Route::apiResource('variant', VariantController::class);

Route::post('promo/{id}/attach-motors', [PromoController::class, 'attachMotors']);
Route::post('promo/{id}/detach-motors', [PromoController::class, 'detachMotors']);
Route::get('promo/{id}/motors', [PromoController::class, 'getMotors']);
Route::get('active-promos', [PromoController::class, 'activePromos']);

// Variant routes
Route::apiResource('variant', VariantController::class);
Route::get('variant/{var}/motors', [VariantController::class, 'getMotors']);
Route::get('model/{id_model}/variants', [VariantController::class, 'getByModel']);
Route::get('active-variants', [VariantController::class, 'getActive']);

//Brosur Route 
Route::apiResource('brosur', BrosurController::class);
Route::get('motor/{id_motorcycle}/brosurs', [BrosurController::class, 'getByMotor']);
Route::get('latest-brosurs', [BrosurController::class, 'getLatest']);
Route::post('brosur/search', [BrosurController::class, 'search']);

