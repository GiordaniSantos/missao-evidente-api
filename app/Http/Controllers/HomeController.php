<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membresia;
use App\Models\Ato;
use App\Models\Pregacao;
use App\Models\Crente;
use App\Models\Incredulo;
use App\Models\Presidio;

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

        $queryAtosPastorais = Ato::query();
        $queryAtosPastorais->where('id_usuario', \Auth::user()->id);
        $queryAtosPastorais->orderBy('created_at', 'desc');

        $queryPregacao = Pregacao::query();
        $queryPregacao->where('id_usuario', \Auth::user()->id);
        $queryPregacao->orderBy('created_at', 'desc');

        $queryVisitasCrentes = Crente::query();
        $queryVisitasCrentes->where('id_usuario', \Auth::user()->id);

        $queryVisitasNaoCrentes = Incredulo::query();
        $queryVisitasNaoCrentes->where('id_usuario', \Auth::user()->id);

        $queryVisitasPresidios = Presidio::query();
        $queryVisitasPresidios->where('id_usuario', \Auth::user()->id);

        if ($request->has('ano')) {
            $queryMembresias->whereYear('created_at', '=', $request->ano);
            $queryAtosPastorais->whereYear('created_at', '=', $request->ano);
            $queryPregacao->whereYear('created_at', '=', $request->ano);
            $queryVisitasCrentes->whereYear('created_at', '=', $request->ano);
            $queryVisitasNaoCrentes->whereYear('created_at', '=', $request->ano);
            $queryVisitasPresidios->whereYear('created_at', '=', $request->ano);
        }else{
            $queryMembresias->whereYear('created_at', '=', $ano);
            $queryAtosPastorais->whereYear('created_at', '=', $ano);
            $queryPregacao->whereYear('created_at', '=', $ano);
            $queryVisitasCrentes->whereYear('created_at', '=', $ano);
            $queryVisitasNaoCrentes->whereYear('created_at', '=', $ano);
            $queryVisitasPresidios->whereYear('created_at', '=', $ano);
        }

        if ($request->has('mes')) {
            $queryMembresias->whereMonth('created_at', '=', $request->mes);
            $queryAtosPastorais->whereMonth('created_at', '=', $request->mes);
            $queryPregacao->whereMonth('created_at', '=', $request->mes);
            $queryVisitasCrentes->whereMonth('created_at', '=', $request->mes);
            $queryVisitasNaoCrentes->whereMonth('created_at', '=', $request->mes);
            $queryVisitasPresidios->whereMonth('created_at', '=', $request->mes);
        }else{
            $queryMembresias->whereMonth('created_at', '=', $mes);
            $queryAtosPastorais->whereMonth('created_at', '=', $mes);
            $queryPregacao->whereMonth('created_at', '=', $mes);
            $queryVisitasCrentes->whereMonth('created_at', '=', $mes);
            $queryVisitasNaoCrentes->whereMonth('created_at', '=', $mes);
            $queryVisitasPresidios->whereMonth('created_at', '=', $mes);
        }

        $atos = $queryAtosPastorais->get();
        $membresias = $queryMembresias->get();
        $pregacoes = $queryPregacao->get();
        $crentes = $queryVisitasCrentes->count();
        $incredulos = $queryVisitasNaoCrentes->count();
        $presidios = $queryVisitasPresidios->count();

        return view('home', [
                'membresias' => $membresias,
                'atos' => $atos,
                'pregacoes' => $pregacoes,
                'crentes' => $crentes,
                'incredulos' => $incredulos,
                'presidios' => $presidios
            ]);
    }
}
