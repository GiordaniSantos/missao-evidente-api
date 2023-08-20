<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('membresia', \App\Http\Controllers\Api\MembresiaController::class); 

    Route::apiResource('ato-pastoral', \App\Http\Controllers\Api\AtoController::class); 

    Route::apiResource('pregacao', \App\Http\Controllers\Api\PregacaoController::class); 

    Route::apiResource('crente', \App\Http\Controllers\Api\CrenteController::class); 

    Route::apiResource('incredulo', \App\Http\Controllers\Api\IncreduloController::class); 

    Route::apiResource('presidio', \App\Http\Controllers\Api\PresidioController::class); 

    Route::apiResource('enfermo', \App\Http\Controllers\Api\EnfermoController::class); 

    Route::apiResource('hospital', \App\Http\Controllers\Api\HospitalController::class); 

    Route::apiResource('escola', \App\Http\Controllers\Api\EscolaController::class); 

    Route::get('dashboard', [\App\Http\Controllers\Api\DashboardController::class, 'index']);
});

Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

Route::post('signup', [\App\Http\Controllers\Api\AuthController::class, 'signup']);

Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::post('refresh', [\App\Http\Controllers\Api\AuthController::class, 'refresh']);

Route::post('me', [\App\Http\Controllers\Api\AuthController::class, 'me']);

