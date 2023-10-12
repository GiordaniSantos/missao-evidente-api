<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->prefix('/admin')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/table', function () {
        return view('admin.table');
    })->name('table');
    //membresia
    Route::resource('membresia', \App\Http\Controllers\MembresiaController::class)->except(['edit', 'update']);
    Route::get('/membresia/{id}/edit', [\App\Http\Controllers\MembresiaController::class, 'edit'])->name('membresia.edit');
    Route::put('/membresia/{id}', [\App\Http\Controllers\MembresiaController::class, 'update'])->name('membresia.update');
    Route::delete('/membresia/{id}', [\App\Http\Controllers\MembresiaController::class, 'destroy'])->name('membresia.destroy');
    
    //atos pastorais
    Route::resource('atos-pastorais', \App\Http\Controllers\AtoController::class)->except(['edit', 'update']);
    Route::get('/atos-pastorais/{id}/edit', [\App\Http\Controllers\AtoController::class, 'edit'])->name('atos-pastorais.edit');
    Route::put('/atos-pastorais/{id}', [\App\Http\Controllers\AtoController::class, 'update'])->name('atos-pastorais.update');
    Route::delete('/atos-pastorais/{id}', [\App\Http\Controllers\AtoController::class, 'destroy'])->name('atos-pastorais.destroy');

    //pregacoes
    Route::resource('pregacao', \App\Http\Controllers\PregacaoController::class)->except(['edit', 'update']);
    Route::get('/pregacao/{id}/edit', [\App\Http\Controllers\PregacaoController::class, 'edit'])->name('pregacao.edit');
    Route::put('/pregacao/{id}', [\App\Http\Controllers\PregacaoController::class, 'update'])->name('pregacao.update');
    Route::delete('/pregacao/{id}', [\App\Http\Controllers\PregacaoController::class, 'destroy'])->name('pregacao.destroy');

    //visita crente
    Route::resource('crente', \App\Http\Controllers\CrenteController::class)->except(['edit', 'update']);
    Route::get('/crente/{id}/edit', [\App\Http\Controllers\CrenteController::class, 'edit'])->name('crente.edit');
    Route::put('/crente/{id}', [\App\Http\Controllers\CrenteController::class, 'update'])->name('crente.update');
    Route::delete('/crente/{id}', [\App\Http\Controllers\CrenteController::class, 'destroy'])->name('crente.destroy');

    //visita não crente
    Route::resource('nao-crente', \App\Http\Controllers\IncreduloController::class)->except(['edit', 'update']);
    Route::delete('/nao-crente/{id}', [\App\Http\Controllers\IncreduloController::class, 'destroy'])->name('nao-crente.destroy');

    //visita presidios
    Route::resource('presidio', \App\Http\Controllers\PresidioController::class)->except(['edit', 'update']);
    Route::delete('/presidio/{id}', [\App\Http\Controllers\PresidioController::class, 'destroy'])->name('presidio.destroy');

    //visita enfermos
    Route::resource('enfermo', \App\Http\Controllers\EnfermoController::class)->except(['edit', 'update']);
    Route::delete('/enfermo/{id}', [\App\Http\Controllers\EnfermoController::class, 'destroy'])->name('enfermo.destroy');

    //visita hospitais
    Route::resource('hospital', \App\Http\Controllers\HospitalController::class)->except(['edit', 'update']);
    Route::delete('/hospital/{id}', [\App\Http\Controllers\HospitalController::class, 'destroy'])->name('hospital.destroy');

    //visita escolas
    Route::resource('escola', \App\Http\Controllers\EscolaController::class)->except(['edit', 'update']);
    Route::delete('/escola/{id}', [\App\Http\Controllers\EscolaController::class, 'destroy'])->name('escola.destroy');

    //relatórios gerais
    Route::get('/relatorio-geral', [App\Http\Controllers\RelatorioGeralController::class, 'index'])->name('relatorio.index');
    Route::get('/relatorio-geral-dados-visitacao', [App\Http\Controllers\RelatorioGeralController::class, 'dadosVisitacao']);
    Route::get('/relatorio-geral-dados-atos-pastorais', [App\Http\Controllers\RelatorioGeralController::class, 'dadosAtosPastorais']);
    Route::get('/relatorio-geral-dados-pregacoes', [App\Http\Controllers\RelatorioGeralController::class, 'dadosPregacao']);
    Route::get('/relatorio-geral-dados-membresia', [App\Http\Controllers\RelatorioGeralController::class, 'dadosMembresia']);
});


