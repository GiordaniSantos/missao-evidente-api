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

        $queryAtosPastorais = Ato::query();
        $queryAtosPastorais->where('id_usuario', $id_usuario);
        $queryAtosPastorais->orderBy('created_at', 'desc');

        $queryPregacao = Pregacao::query();
        $queryPregacao->where('id_usuario', $id_usuario);
        $queryPregacao->orderBy('created_at', 'desc');

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
            $queryAtosPastorais->whereYear('created_at', '=', $ano);
            $queryPregacao->whereYear('created_at', '=', $ano);
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
        //}

        if ($requestMes) {
            $queryMembresias->whereMonth('created_at', '=', $requestMes);
            $queryAtosPastorais->whereMonth('created_at', '=', $requestMes);
            $queryPregacao->whereMonth('created_at', '=', $requestMes);
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
        }else{
            $queryMembresias->whereMonth('created_at', '=', $mes);
            $queryAtosPastorais->whereMonth('created_at', '=', $mes);
            $queryPregacao->whereMonth('created_at', '=', $mes);
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
        }
        
        $atos = $queryAtosPastorais->get();
        $atosG['atos'] = $atos;
        $membresias = $queryMembresias->get();
        $membresiasG['membresias'] = $membresias;
        $pregacoes = $queryPregacao->get();
        $pregacoesG['pregacoes'] = $pregacoes;
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

        return response()->json([$atosG, $membresiasG, $pregacoesG, $crentesG, $incredulosG, $presidiosG, $enfermosG, $hospitaisG, $escolasG, $batismoG, $batismoProfissaoG, $bencaoNupcialG, $santaCeiaG], 200);
    }

}