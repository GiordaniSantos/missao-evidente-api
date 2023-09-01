<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Membresia;
use App\Models\Ato;
use App\Models\Pregacao;
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
        $ano = date('Y');

        $requestMes = request('mes');
        $requestAno = request('ano');

        $queryMembresias = Membresia::query();
        $queryMembresias->where('id_usuario', $id_usuario);
        $queryMembresias->orderBy('created_at', 'asc');

        $queryVisitasCrentes = Crente::query();
        $queryVisitasCrentes->where('id_usuario', $id_usuario);

        $queryVisitasNaoCrentes = Incredulo::query();
        $queryVisitasNaoCrentes->where('id_usuario', $id_usuario);

        $queryVisitasPresidios = Presidio::query();
        $queryVisitasPresidios->where('id_usuario', $id_usuario);

        $queryVisitasEnfermos = Enfermo::query();
        $queryVisitasEnfermos->where('id_usuario', $id_usuario);

        $queryVisitasHospitais = Hospital::query();
        $queryVisitasHospitais->where('id_usuario', $id_usuario);

        $queryVisitasEscolas = Escola::query();
        $queryVisitasEscolas->where('id_usuario', $id_usuario);

        $queryBatismoInfantil = BatismoInfantil::query();
        $queryBatismoInfantil->where('id_usuario', $id_usuario);

        $queryBatismoProfissao = BatismoProfissao::query();
        $queryBatismoProfissao->where('id_usuario', $id_usuario);

        $queryBencaoNupcial = BencaoNupcial::query();
        $queryBencaoNupcial->where('id_usuario', $id_usuario);

        $querySantaCeia = SantaCeia::query();
        $querySantaCeia->where('id_usuario', $id_usuario);

        $queryEstudo = Estudo::query();
        $queryEstudo->where('id_usuario', $id_usuario);

        $querySermao = Sermao::query();
        $querySermao->where('id_usuario', $id_usuario);

        $queryEstudoBiblico = EstudoBiblico::query();
        $queryEstudoBiblico->where('id_usuario', $id_usuario);

        $queryDiscipulado = Discipulado::query();
        $queryDiscipulado->where('id_usuario', $id_usuario);

        /*if ($requestAno) {
            $queryMembresias->whereYear('created_at', '=', $requestAno);
            $queryAtosPastorais->whereYear('created_at', '=', $requestAno);
            $queryPregacao->whereYear('created_at', '=', $requestAno);
            $queryVisitasCrentes->whereYear('created_at', '=', $requestAno);
            $queryVisitasNaoCrentes->whereYear('created_at', '=', $requestAno);
            $queryVisitasPresidios->whereYear('created_at', '=', $requestAno);
            $queryVisitasEnfermos->whereYear('created_at', '=', $requestAno);
            $queryVisitasHospitais->whereYear('created_at', '=', $requestAno);
            $queryVisitasEscolas->whereYear('created_at', '=', $requestAno);
        }else{*/
            $queryMembresias->whereYear('created_at', '=', $ano);
            $queryVisitasCrentes->whereYear('created_at', '=', $ano);
            $queryVisitasNaoCrentes->whereYear('created_at', '=', $ano);
            $queryVisitasPresidios->whereYear('created_at', '=', $ano);
            $queryVisitasEnfermos->whereYear('created_at', '=', $ano);
            $queryVisitasHospitais->whereYear('created_at', '=', $ano);
            $queryVisitasEscolas->whereYear('created_at', '=', $ano);
            $queryBatismoInfantil->whereYear('created_at', '=', $ano);
            $queryBatismoProfissao->whereYear('created_at', '=', $ano);
            $queryBencaoNupcial->whereYear('created_at', '=', $ano);
            $querySantaCeia->whereYear('created_at', '=', $ano);
            $queryEstudo->whereYear('created_at', '=', $ano);
            $querySermao->whereYear('created_at', '=', $ano);
            $queryEstudoBiblico->whereYear('created_at', '=', $ano);
            $queryDiscipulado->whereYear('created_at', '=', $ano);
        //}

        if ($requestMes) {
            $queryMembresias->whereMonth('created_at', '=', $requestMes);
            $queryVisitasCrentes->whereMonth('created_at', '=', $requestMes);
            $queryVisitasNaoCrentes->whereMonth('created_at', '=', $requestMes);
            $queryVisitasPresidios->whereMonth('created_at', '=', $requestMes);
            $queryVisitasEnfermos->whereMonth('created_at', '=', $requestMes);
            $queryVisitasHospitais->whereMonth('created_at', '=', $requestMes);
            $queryVisitasEscolas->whereMonth('created_at', '=', $requestMes);
            $queryBatismoInfantil->whereMonth('created_at', '=', $requestMes);
            $queryBatismoProfissao->whereMonth('created_at', '=', $requestMes);
            $queryBencaoNupcial->whereMonth('created_at', '=', $requestMes);
            $querySantaCeia->whereMonth('created_at', '=', $requestMes);
            $queryEstudo->whereMonth('created_at', '=', $requestMes);
            $querySermao->whereMonth('created_at', '=', $requestMes);
            $queryEstudoBiblico->whereMonth('created_at', '=', $requestMes);
            $queryDiscipulado->whereMonth('created_at', '=', $requestMes);
        }else{
            $queryMembresias->whereMonth('created_at', '=', $mes);
            $queryVisitasCrentes->whereMonth('created_at', '=', $mes);
            $queryVisitasNaoCrentes->whereMonth('created_at', '=', $mes);
            $queryVisitasPresidios->whereMonth('created_at', '=', $mes);
            $queryVisitasEnfermos->whereMonth('created_at', '=', $mes);
            $queryVisitasHospitais->whereMonth('created_at', '=', $mes);
            $queryVisitasEscolas->whereMonth('created_at', '=', $mes);
            $queryBatismoInfantil->whereMonth('created_at', '=', $mes);
            $queryBatismoProfissao->whereMonth('created_at', '=', $mes);
            $queryBencaoNupcial->whereMonth('created_at', '=', $mes);
            $querySantaCeia->whereMonth('created_at', '=', $mes);
            $queryEstudo->whereMonth('created_at', '=', $mes);
            $querySermao->whereMonth('created_at', '=', $mes);
            $queryEstudoBiblico->whereMonth('created_at', '=', $mes);
            $queryDiscipulado->whereMonth('created_at', '=', $mes);
        }
        
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

}