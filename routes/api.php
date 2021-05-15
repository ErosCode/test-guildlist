<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharController;
use App\Http\Controllers\SpecController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\ArmorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Characters routes
Route::get('/chars', [CharController::class, 'index']);
Route::prefix('/char')->group( function () {
    Route::get('/{id}', [CharController::class, 'show']);
    Route::post('/store', [CharController::class, 'store']);
    Route::put('/{id}', [CharController::class, 'update']);
    Route::delete('/{id}', [CharController::class, 'destroy']);
});

//Races routes
Route::get('/races', [RaceController::class, 'index']);
Route::prefix('/race')->group( function () {
    Route::get('/{id}', [RaceController::class, 'show']);
    Route::post('/store', [RaceController::class, 'store']);
    Route::put('/{id}', [RaceController::class, 'update']);
    Route::delete('/{id}', [RaceController::class, 'destroy']);
});

//Classes routes
Route::get('/classes', [ClasseController::class, 'index']);
Route::prefix('/classe')->group( function () {
    Route::get('/{id}', [ClasseController::class, 'show']);
    Route::post('/store', [ClasseController::class, 'store']);
    Route::put('/{id}', [ClasseController::class, 'update']);
    Route::delete('/{id}', [ClasseController::class, 'destroy']);
});

//Specs routes
Route::get('/specs', [SpecController::class, 'index']);
Route::prefix('/spec')->group( function () {
    Route::get('/{id}', [SpecController::class, 'show']);
    Route::post('/store', [SpecController::class, 'store']);
    Route::put('/{id}', [SpecController::class, 'update']);
    Route::delete('/{id}', [SpecController::class, 'destroy']);
});

//Armors routes
Route::get('/armors', [ArmorController::class, 'index']);
Route::prefix('/armor')->group( function () {
    Route::get('/{id}', [ArmorController::class, 'show']);
    Route::post('/store', [ArmorController::class, 'store']);
    Route::put('/{id}', [ArmorController::class, 'update']);
    Route::delete('/{id}', [ArmorController::class, 'destroy']);
});