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
    Route::get('/nao-crente/{id}/edit', [\App\Http\Controllers\IncreduloController::class, 'edit'])->name('nao-crente.edit');
    Route::put('/nao-crente/{id}', [\App\Http\Controllers\IncreduloController::class, 'update'])->name('nao-crente.update');
    Route::delete('/nao-crente/{id}', [\App\Http\Controllers\IncreduloController::class, 'destroy'])->name('nao-crente.destroy');

    //visita presidios
    Route::resource('presidio', \App\Http\Controllers\PresidioController::class)->except(['edit', 'update']);
    Route::get('/presidio/{id}/edit', [\App\Http\Controllers\PresidioController::class, 'edit'])->name('presidio.edit');
    Route::put('/presidio/{id}', [\App\Http\Controllers\PresidioController::class, 'update'])->name('presidio.update');
    Route::delete('/presidio/{id}', [\App\Http\Controllers\PresidioController::class, 'destroy'])->name('presidio.destroy');

    //visita enfermos
    Route::resource('enfermo', \App\Http\Controllers\EnfermoController::class)->except(['edit', 'update']);
    Route::get('/enfermo/{id}/edit', [\App\Http\Controllers\EnfermoController::class, 'edit'])->name('enfermo.edit');
    Route::put('/enfermo/{id}', [\App\Http\Controllers\EnfermoController::class, 'update'])->name('enfermo.update');
    Route::delete('/enfermo/{id}', [\App\Http\Controllers\EnfermoController::class, 'destroy'])->name('enfermo.destroy');

    //visita hospitais
    Route::resource('hospital', \App\Http\Controllers\HospitalController::class)->except(['edit', 'update']);
    Route::get('/hospital/{id}/edit', [\App\Http\Controllers\HospitalController::class, 'edit'])->name('hospital.edit');
    Route::put('/hospital/{id}', [\App\Http\Controllers\HospitalController::class, 'update'])->name('hospital.update');
    Route::delete('/hospital/{id}', [\App\Http\Controllers\HospitalController::class, 'destroy'])->name('hospital.destroy');

    //visita escolas
    Route::resource('escola', \App\Http\Controllers\EscolaController::class)->except(['edit', 'update']);
    Route::get('/escola/{id}/edit', [\App\Http\Controllers\EscolaController::class, 'edit'])->name('escola.edit');
    Route::put('/escola/{id}', [\App\Http\Controllers\EscolaController::class, 'update'])->name('escola.update');
    Route::delete('/escola/{id}', [\App\Http\Controllers\EscolaController::class, 'destroy'])->name('escola.destroy');

    //batismos infantis
    Route::resource('batismo-infantil', \App\Http\Controllers\BatismoInfantilController::class)->except(['edit', 'update']);
    Route::get('/batismo-infantil/{id}/edit', [\App\Http\Controllers\BatismoInfantilController::class, 'edit'])->name('batismo-infantil.edit');
    Route::put('/batismo-infantil/{id}', [\App\Http\Controllers\BatismoInfantilController::class, 'update'])->name('batismo-infantil.update');
    Route::delete('/batismo-infantil/{id}', [\App\Http\Controllers\BatismoInfantilController::class, 'destroy'])->name('batismo-infantil.destroy');

    //batismos e profissões de fé
    Route::resource('batismo-profissao', \App\Http\Controllers\BatismoProfissaoController::class)->except(['edit', 'update']);
    Route::get('/batismo-profissao/{id}/edit', [\App\Http\Controllers\BatismoProfissaoController::class, 'edit'])->name('batismo-profissao.edit');
    Route::put('/batismo-profissao/{id}', [\App\Http\Controllers\BatismoProfissaoController::class, 'update'])->name('batismo-profissao.update');
    Route::delete('/batismo-profissao/{id}', [\App\Http\Controllers\BatismoProfissaoController::class, 'destroy'])->name('batismo-profissao.destroy');

    //benções nupciais
    Route::resource('bencao-nupcial', \App\Http\Controllers\BencaoNupcialController::class)->except(['edit', 'update']);
    Route::get('/bencao-nupcial/{id}/edit', [\App\Http\Controllers\BencaoNupcialController::class, 'edit'])->name('bencao-nupcial.edit');
    Route::put('/bencao-nupcial/{id}', [\App\Http\Controllers\BencaoNupcialController::class, 'update'])->name('bencao-nupcial.update');
    Route::delete('/bencao-nupcial/{id}', [\App\Http\Controllers\BencaoNupcialController::class, 'destroy'])->name('bencao-nupcial.destroy');

    //santas ceias
    Route::resource('santa-ceia', \App\Http\Controllers\SantaCeiaController::class)->except(['edit', 'update']);
    Route::get('/santa-ceia/{id}/edit', [\App\Http\Controllers\SantaCeiaController::class, 'edit'])->name('santa-ceia.edit');
    Route::put('/santa-ceia/{id}', [\App\Http\Controllers\SantaCeiaController::class, 'update'])->name('santa-ceia.update');
    Route::delete('/santa-ceia/{id}', [\App\Http\Controllers\SantaCeiaController::class, 'destroy'])->name('santa-ceia.destroy');

    //estudos
    Route::resource('estudo', \App\Http\Controllers\EstudoController::class)->except(['edit', 'update']);
    Route::get('/estudo/{id}/edit', [\App\Http\Controllers\EstudoController::class, 'edit'])->name('estudo.edit');
    Route::put('/estudo/{id}', [\App\Http\Controllers\EstudoController::class, 'update'])->name('estudo.update');
    Route::delete('/estudo/{id}', [\App\Http\Controllers\EstudoController::class, 'destroy'])->name('estudo.destroy');

    //sermões
    Route::resource('sermao', \App\Http\Controllers\SermaoController::class)->except(['edit', 'update']);
    Route::get('/sermao/{id}/edit', [\App\Http\Controllers\SermaoController::class, 'edit'])->name('sermao.edit');
    Route::put('/sermao/{id}', [\App\Http\Controllers\SermaoController::class, 'update'])->name('sermao.update');
    Route::delete('/sermao/{id}', [\App\Http\Controllers\SermaoController::class, 'destroy'])->name('sermao.destroy');
    
    //estudos biblicos
    Route::resource('estudo-biblico', \App\Http\Controllers\EstudoBiblicoController::class)->except(['edit', 'update']);
    Route::get('/estudo-biblico/{id}/edit', [\App\Http\Controllers\EstudoBiblicoController::class, 'edit'])->name('estudo-biblico.edit');
    Route::put('/estudo-biblico/{id}', [\App\Http\Controllers\EstudoBiblicoController::class, 'update'])->name('estudo-biblico.update');
    Route::delete('/estudo-biblico/{id}', [\App\Http\Controllers\EstudoBiblicoController::class, 'destroy'])->name('estudo-biblico.destroy');

    //discipulados
    Route::resource('discipulado', \App\Http\Controllers\DiscipuladoController::class)->except(['edit', 'update']);
    Route::get('/discipulado/{id}/edit', [\App\Http\Controllers\DiscipuladoController::class, 'edit'])->name('discipulado.edit');
    Route::put('/discipulado/{id}', [\App\Http\Controllers\DiscipuladoController::class, 'update'])->name('discipulado.update');
    Route::delete('/discipulado/{id}', [\App\Http\Controllers\DiscipuladoController::class, 'destroy'])->name('discipulado.destroy');

    //relatórios gerais
    Route::get('/relatorio-geral', [App\Http\Controllers\RelatorioGeralController::class, 'index'])->name('relatorio.index');
    Route::get('/relatorio-geral-dados-visitacao', [App\Http\Controllers\RelatorioGeralController::class, 'dadosVisitacao']);
    Route::get('/relatorio-geral-dados-atos-pastorais', [App\Http\Controllers\RelatorioGeralController::class, 'dadosAtosPastorais']);
    Route::get('/relatorio-geral-dados-pregacoes', [App\Http\Controllers\RelatorioGeralController::class, 'dadosPregacao']);
    Route::get('/relatorio-geral-dados-membresia', [App\Http\Controllers\RelatorioGeralController::class, 'dadosMembresia']);
});


