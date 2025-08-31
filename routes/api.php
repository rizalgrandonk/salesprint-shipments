<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/track", [Controllers\ShipmentController::class, "track"]);
Route::get("/destination/province", [Controllers\LogisticController::class, "province"]);
Route::get("/destination/city/{province_id}", [Controllers\LogisticController::class, "city"]);
Route::get("/destination/district/{city_id}", [Controllers\LogisticController::class, "district"]);
Route::post(
    "/calculate/district/domestic-cost", 
    [Controllers\LogisticController::class, "cost"]
);
