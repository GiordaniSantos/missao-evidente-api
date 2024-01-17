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

    Route::apiResource('crente', \App\Http\Controllers\Api\CrenteController::class); 

    Route::apiResource('incredulo', \App\Http\Controllers\Api\IncreduloController::class); 

    Route::apiResource('presidio', \App\Http\Controllers\Api\PresidioController::class); 

    Route::apiResource('enfermo', \App\Http\Controllers\Api\EnfermoController::class); 

    Route::apiResource('hospital', \App\Http\Controllers\Api\HospitalController::class); 

    Route::apiResource('escola', \App\Http\Controllers\Api\EscolaController::class); 

    Route::apiResource('batismo-infantil', \App\Http\Controllers\Api\BatismoInfantilController::class); 

    Route::apiResource('batismo-profissao', \App\Http\Controllers\Api\BatismoProfissaoController::class); 

    Route::apiResource('bencao-nupcial', \App\Http\Controllers\Api\BencaoNupcialController::class); 

    Route::apiResource('santa-ceia', \App\Http\Controllers\Api\SantaCeiaController::class); 

    Route::apiResource('estudo', \App\Http\Controllers\Api\EstudoController::class); 
    
    Route::apiResource('sermao', \App\Http\Controllers\Api\SermaoController::class); 

    Route::apiResource('estudo-biblico', \App\Http\Controllers\Api\EstudoBiblicoController::class); 

    Route::apiResource('discipulado', \App\Http\Controllers\Api\DiscipuladoController::class); 

    Route::get('dashboard', [\App\Http\Controllers\Api\DashboardController::class, 'index']);

    Route::get('relatorio-anual', [\App\Http\Controllers\Api\DashboardController::class, 'relatorioAnual']);
});

Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

Route::post('signup', [\App\Http\Controllers\Api\AuthController::class, 'signup']);

Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::post('refresh', [\App\Http\Controllers\Api\AuthController::class, 'refresh']);

Route::post('me', [\App\Http\Controllers\Api\AuthController::class, 'me']);

