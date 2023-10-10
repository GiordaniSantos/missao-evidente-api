<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $mes = date('m');
        $ano = date('Y');

        $queryMembresias = Membresia::query();
        $queryMembresias->where('id_usuario', \Auth::user()->id);
        $queryMembresias->orderBy('created_at', 'asc');

        $queryVisitasCrentes = Crente::query();
        $queryVisitasCrentes->where('id_usuario', \Auth::user()->id);

        $queryVisitasNaoCrentes = Incredulo::query();
        $queryVisitasNaoCrentes->where('id_usuario', \Auth::user()->id);

        $queryVisitasPresidios = Presidio::query();
        $queryVisitasPresidios->where('id_usuario', \Auth::user()->id);

        $queryVisitasEnfermos = Enfermo::query();
        $queryVisitasEnfermos->where('id_usuario', \Auth::user()->id);

        $queryVisitasHospitais = Hospital::query();
        $queryVisitasHospitais->where('id_usuario', \Auth::user()->id);

        $queryVisitasEscolas = Escola::query();
        $queryVisitasEscolas->where('id_usuario', \Auth::user()->id);

        $queryBatismoInfantil = BatismoInfantil::query();
        $queryBatismoInfantil->where('id_usuario', \Auth::user()->id);

        $queryBatismoProfissao = BatismoProfissao::query();
        $queryBatismoProfissao->where('id_usuario', \Auth::user()->id);

        $queryBencaoNupcial = BencaoNupcial::query();
        $queryBencaoNupcial->where('id_usuario', \Auth::user()->id);

        $querySantaCeia = SantaCeia::query();
        $querySantaCeia->where('id_usuario', \Auth::user()->id);

        $queryEstudo = Estudo::query();
        $queryEstudo->where('id_usuario', \Auth::user()->id);

        $querySermao = Sermao::query();
        $querySermao->where('id_usuario', \Auth::user()->id);

        $queryEstudoBiblico = EstudoBiblico::query();
        $queryEstudoBiblico->where('id_usuario', \Auth::user()->id);

        $queryDiscipulado = Discipulado::query();
        $queryDiscipulado->where('id_usuario', \Auth::user()->id);

        if ($request->has('ano')) {
            $queryMembresias->whereYear('created_at', '=', $request->ano);
            $queryVisitasCrentes->whereYear('created_at', '=', $request->ano);
            $queryVisitasNaoCrentes->whereYear('created_at', '=', $request->ano);
            $queryVisitasPresidios->whereYear('created_at', '=', $request->ano);
            $queryVisitasEnfermos->whereYear('created_at', '=', $request->ano);
            $queryVisitasHospitais->whereYear('created_at', '=', $request->ano);
            $queryVisitasEscolas->whereYear('created_at', '=', $request->ano);
            $queryBatismoInfantil->whereYear('created_at', '=', $request->ano);
            $queryBatismoProfissao->whereYear('created_at', '=', $request->ano);
            $queryBencaoNupcial->whereYear('created_at', '=', $request->ano);
            $querySantaCeia->whereYear('created_at', '=', $request->ano);
            $queryEstudo->whereYear('created_at', '=', $request->ano);
            $querySermao->whereYear('created_at', '=', $request->ano);
            $queryEstudoBiblico->whereYear('created_at', '=', $request->ano);
            $queryDiscipulado->whereYear('created_at', '=', $request->ano);
        }else{
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
        }

        if ($request->has('mes')) {
            $queryMembresias->whereMonth('created_at', '=', $request->mes);
            $queryVisitasCrentes->whereMonth('created_at', '=', $request->mes);
            $queryVisitasNaoCrentes->whereMonth('created_at', '=', $request->mes);
            $queryVisitasPresidios->whereMonth('created_at', '=', $request->mes);
            $queryVisitasEnfermos->whereMonth('created_at', '=', $request->mes);
            $queryVisitasHospitais->whereMonth('created_at', '=', $request->mes);
            $queryVisitasEscolas->whereMonth('created_at', '=', $request->mes);
            $queryBatismoInfantil->whereMonth('created_at', '=', $request->mes);
            $queryBatismoProfissao->whereMonth('created_at', '=', $request->mes);
            $queryBencaoNupcial->whereMonth('created_at', '=', $request->mes);
            $querySantaCeia->whereMonth('created_at', '=', $request->mes);
            $queryEstudo->whereMonth('created_at', '=', $request->mes);
            $querySermao->whereMonth('created_at', '=', $request->mes);
            $queryEstudoBiblico->whereMonth('created_at', '=', $request->mes);
            $queryDiscipulado->whereMonth('created_at', '=', $request->mes);
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
        $crentes = $queryVisitasCrentes->count();
        $incredulos = $queryVisitasNaoCrentes->count();
        $presidios = $queryVisitasPresidios->count();
        $enfermos = $queryVisitasEnfermos->count();
        $hospitais = $queryVisitasHospitais->count();
        $escolas = $queryVisitasEscolas->count();
        $batismosInfantis = $queryBatismoInfantil->count();
        $batismosProfissoes = $queryBatismoProfissao->count();
        $bencoesNupciais = $queryBencaoNupcial->count();
        $santasCeias = $querySantaCeia->count();
        $estudos = $queryEstudo->count();
        $sermoes = $querySermao->count();
        $estudosBiblicos = $queryEstudoBiblico->count();
        $discipulados = $queryDiscipulado->count();

        return view('home', [
                'membresias' => $membresias,
                'crentes' => $crentes,
                'incredulos' => $incredulos,
                'presidios' => $presidios,
                'enfermos' => $enfermos,
                'hospitais' => $hospitais,
                'escolas' => $escolas,
                'batismosInfantis' => $batismosInfantis,
                'batismosProfissoes' => $batismosProfissoes,
                'bencoesNupciais' => $bencoesNupciais,
                'santasCeias' => $santasCeias,
                'estudos' => $estudos,
                'sermoes' => $sermoes,
                'estudosBiblicos' => $estudosBiblicos,
                'discipulaods' => $discipulados
            ]);
    }
}
