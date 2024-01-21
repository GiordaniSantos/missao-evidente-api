<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Membresia;
use App\Models\Crente;
use App\Models\Incredulo;
use App\Models\Presidio;
use App\Models\Enfermo;
use App\Models\Hospital;
use App\Models\Escola;
use App\Models\BatismoInfantil;
use App\Models\BatismoProfissao;
use App\Models\BencaoNupcial;
use App\Models\SantaCeia;
use App\Models\Estudo;
use App\Models\Sermao;
use App\Models\EstudoBiblico;
use App\Models\Discipulado;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = request('id_usuario');

        $mes = date('m');
        if($request->has('mes')){
            $mes = request('mes');
        }

        $ano = date('Y');
        if($request->has('ano')){
            $ano = request('ano');
        }

        $queryMembresias = Membresia::query();
        $queryMembresias->where('id_usuario', $id_usuario);
        $queryMembresias->whereYear('created_at', '=', $ano);
        $queryMembresias->whereMonth('created_at', '=', $mes);
        $queryMembresias->orderBy('created_at', 'asc');

        $queryVisitasCrentes = Crente::query();
        $queryVisitasCrentes->whereYear('created_at', '=', $ano);
        $queryVisitasCrentes->whereMonth('created_at', '=', $mes);
        $queryVisitasCrentes->where('id_usuario', $id_usuario);

        $queryVisitasNaoCrentes = Incredulo::query();
        $queryVisitasNaoCrentes->whereYear('created_at', '=', $ano);
        $queryVisitasNaoCrentes->whereMonth('created_at', '=', $mes);
        $queryVisitasNaoCrentes->where('id_usuario', $id_usuario);

        $queryVisitasPresidios = Presidio::query();
        $queryVisitasPresidios->whereYear('created_at', '=', $ano);
        $queryVisitasPresidios->whereMonth('created_at', '=', $mes);
        $queryVisitasPresidios->where('id_usuario', $id_usuario);

        $queryVisitasEnfermos = Enfermo::query();
        $queryVisitasEnfermos->whereYear('created_at', '=', $ano);
        $queryVisitasEnfermos->whereMonth('created_at', '=', $mes);
        $queryVisitasEnfermos->where('id_usuario', $id_usuario);

        $queryVisitasHospitais = Hospital::query();
        $queryVisitasHospitais->whereYear('created_at', '=', $ano);
        $queryVisitasHospitais->whereMonth('created_at', '=', $mes);
        $queryVisitasHospitais->where('id_usuario', $id_usuario);

        $queryVisitasEscolas = Escola::query();
        $queryVisitasEscolas->whereYear('created_at', '=', $ano);
        $queryVisitasEscolas->whereMonth('created_at', '=', $mes);
        $queryVisitasEscolas->where('id_usuario', $id_usuario);

        $queryBatismoInfantil = BatismoInfantil::query();
        $queryBatismoInfantil->whereYear('created_at', '=', $ano);
        $queryBatismoInfantil->whereMonth('created_at', '=', $mes);
        $queryBatismoInfantil->where('id_usuario', $id_usuario);

        $queryBatismoProfissao = BatismoProfissao::query();
        $queryBatismoProfissao->whereYear('created_at', '=', $ano);
        $queryBatismoProfissao->whereMonth('created_at', '=', $mes);
        $queryBatismoProfissao->where('id_usuario', $id_usuario);

        $queryBencaoNupcial = BencaoNupcial::query();
        $queryBencaoNupcial->whereYear('created_at', '=', $ano);
        $queryBencaoNupcial->whereMonth('created_at', '=', $mes);
        $queryBencaoNupcial->where('id_usuario', $id_usuario);

        $querySantaCeia = SantaCeia::query();
        $querySantaCeia->whereYear('created_at', '=', $ano);
        $querySantaCeia->whereMonth('created_at', '=', $mes);
        $querySantaCeia->where('id_usuario', $id_usuario);

        $queryEstudo = Estudo::query();
        $queryEstudo->whereYear('created_at', '=', $ano);
        $queryEstudo->whereMonth('created_at', '=', $mes);
        $queryEstudo->where('id_usuario', $id_usuario);

        $querySermao = Sermao::query();
        $querySermao->whereYear('created_at', '=', $ano);
        $querySermao->whereMonth('created_at', '=', $mes);
        $querySermao->where('id_usuario', $id_usuario);

        $queryEstudoBiblico = EstudoBiblico::query();
        $queryEstudoBiblico->whereYear('created_at', '=', $ano);
        $queryEstudoBiblico->whereMonth('created_at', '=', $mes);
        $queryEstudoBiblico->where('id_usuario', $id_usuario);

        $queryDiscipulado = Discipulado::query();
        $queryDiscipulado->whereYear('created_at', '=', $ano);
        $queryDiscipulado->whereMonth('created_at', '=', $mes);
        $queryDiscipulado->where('id_usuario', $id_usuario);

        //encerrando as querys
        $membresias = $queryMembresias->get();
        $membresiasG['membresias'] = $membresias;
        $crentes = $queryVisitasCrentes->count();
        $crentesG['crentes'] = $crentes;
        $incredulos = $queryVisitasNaoCrentes->count();
        $incredulosG['incredulos'] = $incredulos;
        $presidios = $queryVisitasPresidios->count();
        $presidiosG['presidios'] = $presidios;
        $enfermos = $queryVisitasEnfermos->count();
        $enfermosG['enfermos'] = $enfermos;
        $hospitais = $queryVisitasHospitais->count();
        $hospitaisG['hospitais'] = $hospitais;
        $escolas = $queryVisitasEscolas->count();
        $escolasG['escolas'] = $escolas;
        $batismosInfantis = $queryBatismoInfantil->count();
        $batismoG['batismoInfantil'] = $batismosInfantis;
        $batismosProfissoes = $queryBatismoProfissao->count();
        $batismoProfissaoG['batismoProfissao'] = $batismosProfissoes;
        $bencoesNupciais = $queryBencaoNupcial->count();
        $bencaoNupcialG['bencaoNupcial'] = $bencoesNupciais;
        $santasCeias = $querySantaCeia->count();
        $santaCeiaG['santaCeia'] = $santasCeias;
        $estudos = $queryEstudo->count();
        $estudosG['estudo'] = $estudos;
        $sermoes = $querySermao->count();
        $sermoesG['sermao'] = $sermoes;
        $estudosBiblicos = $queryEstudoBiblico->count();
        $estudosBiblicosG['estudoBiblico'] = $estudosBiblicos;
        $discipulados = $queryDiscipulado->count();
        $discipuladosG['discipulado'] = $discipulados;

        return response()->json([$membresiasG, $crentesG, $incredulosG, $presidiosG, $enfermosG, $hospitaisG, $escolasG, $batismoG, $batismoProfissaoG, $bencaoNupcialG, $santaCeiaG, $estudosG, $sermoesG, $estudosBiblicosG, $discipuladosG], 200);
    }

    public function relatorioAnual()
    {
        $id_usuario = request('id_usuario');

        $ano = date('Y');
        if($request->has('ano')){
            $ano = request('ano');
        }

        $queryVisitasCrentes = Crente::query();
        $queryVisitasCrentes->whereYear('created_at', '=', $ano);
        $queryVisitasCrentes->where('id_usuario', $id_usuario);

        $queryVisitasNaoCrentes = Incredulo::query();
        $queryVisitasNaoCrentes->whereYear('created_at', '=', $ano);
        $queryVisitasNaoCrentes->where('id_usuario', $id_usuario);

        $queryVisitasPresidios = Presidio::query();
        $queryVisitasPresidios->whereYear('created_at', '=', $ano);
        $queryVisitasPresidios->where('id_usuario', $id_usuario);

        $queryVisitasEnfermos = Enfermo::query();
        $queryVisitasEnfermos->whereYear('created_at', '=', $ano);
        $queryVisitasEnfermos->where('id_usuario', $id_usuario);

        $queryVisitasHospitais = Hospital::query();
        $queryVisitasHospitais->whereYear('created_at', '=', $ano);
        $queryVisitasHospitais->where('id_usuario', $id_usuario);

        $queryVisitasEscolas = Escola::query();
        $queryVisitasEscolas->whereYear('created_at', '=', $ano);
        $queryVisitasEscolas->where('id_usuario', $id_usuario);

        $queryBatismoInfantil = BatismoInfantil::query();
        $queryBatismoInfantil->whereYear('created_at', '=', $ano);
        $queryBatismoInfantil->where('id_usuario', $id_usuario);

        $queryBatismoProfissao = BatismoProfissao::query();
        $queryBatismoProfissao->whereYear('created_at', '=', $ano);
        $queryBatismoProfissao->where('id_usuario', $id_usuario);

        $queryBencaoNupcial = BencaoNupcial::query();
        $queryBencaoNupcial->whereYear('created_at', '=', $ano);
        $queryBencaoNupcial->where('id_usuario', $id_usuario);

        $querySantaCeia = SantaCeia::query();
        $querySantaCeia->whereYear('created_at', '=', $ano);
        $querySantaCeia->where('id_usuario', $id_usuario);

        $queryEstudo = Estudo::query();
        $queryEstudo->whereYear('created_at', '=', $ano);
        $queryEstudo->where('id_usuario', $id_usuario);

        $querySermao = Sermao::query();
        $querySermao->whereYear('created_at', '=', $ano);
        $querySermao->where('id_usuario', $id_usuario);

        $queryEstudoBiblico = EstudoBiblico::query();
        $queryEstudoBiblico->whereYear('created_at', '=', $ano);
        $queryEstudoBiblico->where('id_usuario', $id_usuario);

        $queryDiscipulado = Discipulado::query();
        $queryDiscipulado->whereYear('created_at', '=', $ano);
        $queryDiscipulado->where('id_usuario', $id_usuario);
        
        $membresias = DB::table('membresias')
        ->where('id_usuario', $id_usuario)
        ->whereYear('created_at', '=', $ano)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $membresiasTotal = Membresia::where('id_usuario', $id_usuario)->whereYear('created_at', '=', $ano)->count();

        $mediaMembresias = 0;
        if($membresias[0]->total){
            $mediaMembresias = $membresias[0]->total / $membresiasTotal;
        }

        //encerrando as querys
        $membresiasG['membresias'] = intval($mediaMembresias);
        $crentes = $queryVisitasCrentes->count();
        $crentesG['crentes'] = $crentes;
        $incredulos = $queryVisitasNaoCrentes->count();
        $incredulosG['incredulos'] = $incredulos;
        $presidios = $queryVisitasPresidios->count();
        $presidiosG['presidios'] = $presidios;
        $enfermos = $queryVisitasEnfermos->count();
        $enfermosG['enfermos'] = $enfermos;
        $hospitais = $queryVisitasHospitais->count();
        $hospitaisG['hospitais'] = $hospitais;
        $escolas = $queryVisitasEscolas->count();
        $escolasG['escolas'] = $escolas;
        $batismosInfantis = $queryBatismoInfantil->count();
        $batismoG['batismoInfantil'] = $batismosInfantis;
        $batismosProfissoes = $queryBatismoProfissao->count();
        $batismoProfissaoG['batismoProfissao'] = $batismosProfissoes;
        $bencoesNupciais = $queryBencaoNupcial->count();
        $bencaoNupcialG['bencaoNupcial'] = $bencoesNupciais;
        $santasCeias = $querySantaCeia->count();
        $santaCeiaG['santaCeia'] = $santasCeias;
        $estudos = $queryEstudo->count();
        $estudosG['estudo'] = $estudos;
        $sermoes = $querySermao->count();
        $sermoesG['sermao'] = $sermoes;
        $estudosBiblicos = $queryEstudoBiblico->count();
        $estudosBiblicosG['estudoBiblico'] = $estudosBiblicos;
        $discipulados = $queryDiscipulado->count();
        $discipuladosG['discipulado'] = $discipulados;

        return response()->json([$membresiasG, $crentesG, $incredulosG, $presidiosG, $enfermosG, $hospitaisG, $escolasG, $batismoG, $batismoProfissaoG, $bencaoNupcialG, $santaCeiaG, $estudosG, $sermoesG, $estudosBiblicosG, $discipuladosG], 200);
    }

}