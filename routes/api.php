<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BatismoInfantilController;
use App\Http\Controllers\Api\BatismoProfissaoController;
use App\Http\Controllers\Api\BencaoNupcialController;
use App\Http\Controllers\Api\ComunganteController;
use App\Http\Controllers\Api\CrenteController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\DiscipuladoController;
use App\Http\Controllers\Api\EnfermoController;
use App\Http\Controllers\Api\EscolaController;
use App\Http\Controllers\Api\EstudoBiblicoController;
use App\Http\Controllers\Api\EstudoController;
use App\Http\Controllers\Api\HospitalController;
use App\Http\Controllers\Api\IncreduloController;
use App\Http\Controllers\Api\MembresiaController;
use App\Http\Controllers\Api\NaoComunganteController;
use App\Http\Controllers\Api\PresidioController;
use App\Http\Controllers\Api\SantaCeiaController;
use App\Http\Controllers\Api\SermaoController;
use App\Models\Comungante;
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
    Route::apiResource('membresia', MembresiaController::class);

    Route::apiResource('comungante', ComunganteController::class);

    Route::apiResource('nao-comungante', NaoComunganteController::class);

    Route::apiResource('crente', CrenteController::class);

    Route::apiResource('incredulo', IncreduloController::class);

    Route::apiResource('presidio', PresidioController::class);

    Route::apiResource('enfermo', EnfermoController::class);

    Route::apiResource('hospital', HospitalController::class);

    Route::apiResource('escola', EscolaController::class);

    Route::apiResource('batismo-infantil', BatismoInfantilController::class);

    Route::apiResource('batismo-profissao', BatismoProfissaoController::class);

    Route::apiResource('bencao-nupcial', BencaoNupcialController::class);

    Route::apiResource('santa-ceia', SantaCeiaController::class);

    Route::apiResource('estudo', EstudoController::class);

    Route::apiResource('sermao', SermaoController::class);

    Route::apiResource('estudo-biblico', EstudoBiblicoController::class);

    Route::apiResource('discipulado', DiscipuladoController::class);

    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::get('relatorio-anual', [DashboardController::class, 'relatorioAnual']);
});

Route::post('logout', [AuthController::class, 'logout']);

Route::post('signup', [AuthController::class, 'signup']);

Route::post('login', [AuthController::class, 'login']);

Route::post('refresh', [AuthController::class, 'refresh']);

Route::post('me', [AuthController::class, 'me']);

