<?php

use App\Http\Controllers\BatismoInfantilController;
use App\Http\Controllers\BatismoProfissaoController;
use App\Http\Controllers\BencaoNupcialController;
use App\Http\Controllers\CrenteController;
use App\Http\Controllers\DiscipuladoController;
use App\Http\Controllers\EnfermoController;
use App\Http\Controllers\EscolaController;
use App\Http\Controllers\EstudoBiblicoController;
use App\Http\Controllers\EstudoController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\IncreduloController;
use App\Http\Controllers\MembresiaController;
use App\Http\Controllers\PresidioController;
use App\Http\Controllers\SantaCeiaController;
use App\Http\Controllers\SermaoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
    Route::resource('membresia', MembresiaController::class)->except(['edit', 'update']);
    Route::get('/membresia/{id}/edit', [MembresiaController::class, 'edit'])->name('membresia.edit');
    Route::put('/membresia/{id}', [MembresiaController::class, 'update'])->name('membresia.update');
    Route::delete('/membresia/{id}', [MembresiaController::class, 'destroy'])->name('membresia.destroy');

    //visita crente
    Route::resource('crente', CrenteController::class)->except(['edit', 'update']);
    Route::get('/crente/{id}/edit', [CrenteController::class, 'edit'])->name('crente.edit');
    Route::put('/crente/{id}', [CrenteController::class, 'update'])->name('crente.update');
    Route::delete('/crente/{id}', [CrenteController::class, 'destroy'])->name('crente.destroy');

    //visita não crente
    Route::resource('nao-crente', IncreduloController::class)->except(['edit', 'update']);
    Route::get('/nao-crente/{id}/edit', [IncreduloController::class, 'edit'])->name('nao-crente.edit');
    Route::put('/nao-crente/{id}', [IncreduloController::class, 'update'])->name('nao-crente.update');
    Route::delete('/nao-crente/{id}', [IncreduloController::class, 'destroy'])->name('nao-crente.destroy');

    //visita presidios
    Route::resource('presidio', PresidioController::class)->except(['edit', 'update']);
    Route::get('/presidio/{id}/edit', [PresidioController::class, 'edit'])->name('presidio.edit');
    Route::put('/presidio/{id}', [PresidioController::class, 'update'])->name('presidio.update');
    Route::delete('/presidio/{id}', [PresidioController::class, 'destroy'])->name('presidio.destroy');

    //visita enfermos
    Route::resource('enfermo', EnfermoController::class)->except(['edit', 'update']);
    Route::get('/enfermo/{id}/edit', [EnfermoController::class, 'edit'])->name('enfermo.edit');
    Route::put('/enfermo/{id}', [EnfermoController::class, 'update'])->name('enfermo.update');
    Route::delete('/enfermo/{id}', [EnfermoController::class, 'destroy'])->name('enfermo.destroy');

    //visita hospitais
    Route::resource('hospital', HospitalController::class)->except(['edit', 'update']);
    Route::get('/hospital/{id}/edit', [HospitalController::class, 'edit'])->name('hospital.edit');
    Route::put('/hospital/{id}', [HospitalController::class, 'update'])->name('hospital.update');
    Route::delete('/hospital/{id}', [HospitalController::class, 'destroy'])->name('hospital.destroy');

    //visita escolas
    Route::resource('escola', EscolaController::class)->except(['edit', 'update']);
    Route::get('/escola/{id}/edit', [EscolaController::class, 'edit'])->name('escola.edit');
    Route::put('/escola/{id}', [EscolaController::class, 'update'])->name('escola.update');
    Route::delete('/escola/{id}', [EscolaController::class, 'destroy'])->name('escola.destroy');

    //batismos infantis
    Route::resource('batismo-infantil', BatismoInfantilController::class)->except(['edit', 'update']);
    Route::get('/batismo-infantil/{id}/edit', [BatismoInfantilController::class, 'edit'])->name('batismo-infantil.edit');
    Route::put('/batismo-infantil/{id}', [BatismoInfantilController::class, 'update'])->name('batismo-infantil.update');
    Route::delete('/batismo-infantil/{id}', [BatismoInfantilController::class, 'destroy'])->name('batismo-infantil.destroy');

    //batismos e profissões de fé
    Route::resource('batismo-profissao', BatismoProfissaoController::class)->except(['edit', 'update']);
    Route::get('/batismo-profissao/{id}/edit', [BatismoProfissaoController::class, 'edit'])->name('batismo-profissao.edit');
    Route::put('/batismo-profissao/{id}', [BatismoProfissaoController::class, 'update'])->name('batismo-profissao.update');
    Route::delete('/batismo-profissao/{id}', [BatismoProfissaoController::class, 'destroy'])->name('batismo-profissao.destroy');

    //benções nupciais
    Route::resource('bencao-nupcial', BencaoNupcialController::class)->except(['edit', 'update']);
    Route::get('/bencao-nupcial/{id}/edit', [BencaoNupcialController::class, 'edit'])->name('bencao-nupcial.edit');
    Route::put('/bencao-nupcial/{id}', [BencaoNupcialController::class, 'update'])->name('bencao-nupcial.update');
    Route::delete('/bencao-nupcial/{id}', [BencaoNupcialController::class, 'destroy'])->name('bencao-nupcial.destroy');

    //santas ceias
    Route::resource('santa-ceia', SantaCeiaController::class)->except(['edit', 'update']);
    Route::get('/santa-ceia/{id}/edit', [SantaCeiaController::class, 'edit'])->name('santa-ceia.edit');
    Route::put('/santa-ceia/{id}', [SantaCeiaController::class, 'update'])->name('santa-ceia.update');
    Route::delete('/santa-ceia/{id}', [SantaCeiaController::class, 'destroy'])->name('santa-ceia.destroy');

    //estudos
    Route::resource('estudo', EstudoController::class)->except(['edit', 'update']);
    Route::get('/estudo/{id}/edit', [EstudoController::class, 'edit'])->name('estudo.edit');
    Route::put('/estudo/{id}', [EstudoController::class, 'update'])->name('estudo.update');
    Route::delete('/estudo/{id}', [EstudoController::class, 'destroy'])->name('estudo.destroy');

    //sermões
    Route::resource('sermao', SermaoController::class)->except(['edit', 'update']);
    Route::get('/sermao/{id}/edit', [SermaoController::class, 'edit'])->name('sermao.edit');
    Route::put('/sermao/{id}', [SermaoController::class, 'update'])->name('sermao.update');
    Route::delete('/sermao/{id}', [SermaoController::class, 'destroy'])->name('sermao.destroy');

    //estudos biblicos
    Route::resource('estudo-biblico', EstudoBiblicoController::class)->except(['edit', 'update']);
    Route::get('/estudo-biblico/{id}/edit', [EstudoBiblicoController::class, 'edit'])->name('estudo-biblico.edit');
    Route::put('/estudo-biblico/{id}', [EstudoBiblicoController::class, 'update'])->name('estudo-biblico.update');
    Route::delete('/estudo-biblico/{id}', [EstudoBiblicoController::class, 'destroy'])->name('estudo-biblico.destroy');

    //discipulados
    Route::resource('discipulado', DiscipuladoController::class)->except(['edit', 'update']);
    Route::get('/discipulado/{id}/edit', [DiscipuladoController::class, 'edit'])->name('discipulado.edit');
    Route::put('/discipulado/{id}', [DiscipuladoController::class, 'update'])->name('discipulado.update');
    Route::delete('/discipulado/{id}', [DiscipuladoController::class, 'destroy'])->name('discipulado.destroy');

    //relatórios gerais
    Route::get('/relatorio-geral', [App\Http\Controllers\RelatorioGeralController::class, 'index'])->name('relatorio.index');
    Route::get('/relatorio-geral-dados-visitacao', [App\Http\Controllers\RelatorioGeralController::class, 'dadosVisitacao']);
    Route::get('/relatorio-geral-dados-atos-pastorais', [App\Http\Controllers\RelatorioGeralController::class, 'dadosAtosPastorais']);
    Route::get('/relatorio-geral-dados-pregacoes', [App\Http\Controllers\RelatorioGeralController::class, 'dadosPregacao']);
    Route::get('/relatorio-geral-dados-membresia', [App\Http\Controllers\RelatorioGeralController::class, 'dadosMembresia']);

    //export csv home
    Route::get('/export-csv', [App\Http\Controllers\HomeController::class, 'exportExcel'])->name('export-excel');

    //export csv relatorio geral
    Route::get('/export-csv-geral', [App\Http\Controllers\RelatorioGeralController::class, 'exportExcel'])->name('export-excel-geral');

    //meu perfil
    Route::get('/meu-perfil', [App\Http\Controllers\UserController::class, 'view'])->name('user.view');
    Route::put('/meu-perfil/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
});

Route::get('/modify-password', function (Request $request) {
    $token = $request->input('token');
    $url = "missaoevidente://missaoevidenteapp.com.br/modify-password?token=$token";
    return Redirect::to($url);
});
