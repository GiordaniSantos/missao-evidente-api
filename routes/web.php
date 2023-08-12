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
    Route::resource('membresia', \App\Http\Controllers\MembresiaController::class);
    Route::get('/fornecedor/editar/{id}/{msg?}', [\App\Http\Controllers\FornecedorController::class, 'editar'])->name('admin.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}', [\App\Http\Controllers\FornecedorController::class, 'excluir'])->name('admin.fornecedor.excluir');
    
    //atos pastorais
    Route::resource('atos-pastorais', \App\Http\Controllers\AtoController::class);

    //pregacoes
    Route::resource('pregacao', \App\Http\Controllers\PregacaoController::class);
});


