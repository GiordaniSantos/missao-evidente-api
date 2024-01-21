<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('home', $this->getDados($request));
    }

    public function getDados($request){
        $mes = date('m');
        if($request->has('mes')){
            $mes = $request->mes;
        }

        $ano = date('Y');
        if($request->has('ano')){
            $ano = $request->ano;
        }

        $queryMembresias = Membresia::query();
        $queryMembresias->where('id_usuario', \Auth::user()->id);
        $queryMembresias->whereYear('created_at', '=', $ano);
        $queryMembresias->whereMonth('created_at', '=', $mes);
        $queryMembresias->orderBy('created_at', 'asc');

        $queryVisitasCrentes = Crente::query();
        $queryVisitasCrentes->whereYear('created_at', '=', $ano);
        $queryVisitasCrentes->whereMonth('created_at', '=', $mes);
        $queryVisitasCrentes->where('id_usuario', \Auth::user()->id);

        $queryVisitasNaoCrentes = Incredulo::query();
        $queryVisitasNaoCrentes->whereYear('created_at', '=', $ano);
        $queryVisitasNaoCrentes->whereMonth('created_at', '=', $mes);
        $queryVisitasNaoCrentes->where('id_usuario', \Auth::user()->id);

        $queryVisitasPresidios = Presidio::query();
        $queryVisitasPresidios->whereYear('created_at', '=', $ano);
        $queryVisitasPresidios->whereMonth('created_at', '=', $mes);
        $queryVisitasPresidios->where('id_usuario', \Auth::user()->id);

        $queryVisitasEnfermos = Enfermo::query();
        $queryVisitasEnfermos->whereYear('created_at', '=', $ano);
        $queryVisitasEnfermos->whereMonth('created_at', '=', $mes);
        $queryVisitasEnfermos->where('id_usuario', \Auth::user()->id);

        $queryVisitasHospitais = Hospital::query();
        $queryVisitasHospitais->whereYear('created_at', '=', $ano);
        $queryVisitasHospitais->whereMonth('created_at', '=', $mes);
        $queryVisitasHospitais->where('id_usuario', \Auth::user()->id);

        $queryVisitasEscolas = Escola::query();
        $queryVisitasEscolas->whereYear('created_at', '=', $ano);
        $queryVisitasEscolas->whereMonth('created_at', '=', $mes);
        $queryVisitasEscolas->where('id_usuario', \Auth::user()->id);

        $queryBatismoInfantil = BatismoInfantil::query();
        $queryBatismoInfantil->whereYear('created_at', '=', $ano);
        $queryBatismoInfantil->whereMonth('created_at', '=', $mes);
        $queryBatismoInfantil->where('id_usuario', \Auth::user()->id);

        $queryBatismoProfissao = BatismoProfissao::query();
        $queryBatismoProfissao->whereYear('created_at', '=', $ano);
        $queryBatismoProfissao->whereMonth('created_at', '=', $mes);
        $queryBatismoProfissao->where('id_usuario', \Auth::user()->id);

        $queryBencaoNupcial = BencaoNupcial::query();
        $queryBencaoNupcial->whereYear('created_at', '=', $ano);
        $queryBencaoNupcial->whereMonth('created_at', '=', $mes);
        $queryBencaoNupcial->where('id_usuario', \Auth::user()->id);

        $querySantaCeia = SantaCeia::query();
        $querySantaCeia->whereYear('created_at', '=', $ano);
        $querySantaCeia->whereMonth('created_at', '=', $mes);
        $querySantaCeia->where('id_usuario', \Auth::user()->id);

        $queryEstudo = Estudo::query();
        $queryEstudo->whereYear('created_at', '=', $ano);
        $queryEstudo->whereMonth('created_at', '=', $mes);
        $queryEstudo->where('id_usuario', \Auth::user()->id);

        $querySermao = Sermao::query();
        $querySermao->whereYear('created_at', '=', $ano);
        $querySermao->whereMonth('created_at', '=', $mes);
        $querySermao->where('id_usuario', \Auth::user()->id);

        $queryEstudoBiblico = EstudoBiblico::query();
        $queryEstudoBiblico->whereYear('created_at', '=', $ano);
        $queryEstudoBiblico->whereMonth('created_at', '=', $mes);
        $queryEstudoBiblico->where('id_usuario', \Auth::user()->id);

        $queryDiscipulado = Discipulado::query();
        $queryDiscipulado->whereYear('created_at', '=', $ano);
        $queryDiscipulado->whereMonth('created_at', '=', $mes);
        $queryDiscipulado->where('id_usuario', \Auth::user()->id);

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

        return [
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
            'discipulados' => $discipulados,
            'mes' => $mes,
            'ano' => $ano
        ];
    }

    public function exportExcel(Request $request){

        $dadosRecuperados = $this->getDados($request);

        if($dadosRecuperados['membresias']){
            $conteudoMembresia = $this->montaConteudoMembresiaExcel($dadosRecuperados);  
        }

        $dados = [
            [
                'coluna1' => 'Visita Crentes',
                'coluna2' => 'Visita Não Crentes',
                'coluna3' => 'Visita Presidios',
                'coluna4' => 'Visita Enfermos',
                'coluna5' => 'Visita Hospitais',
                'coluna6' => 'Visita Escolas',
                'coluna7' => 'Estudos',
                'coluna8' => 'Sermões',
                'coluna9' => 'Estudos Biblicos',
                'coluna10' => 'Discipulado',
                'coluna11' => 'Batismos Infantis',
                'coluna12' => 'Batismo/Profissões de Fé',
                'coluna13' => 'Benções Nupciais',
                'coluna14' => 'Santas Ceias',
                'coluna15' => 'Membresia'
            ],
            [
                'linha1' => $dadosRecuperados['crentes'],
                'linha2' => $dadosRecuperados['incredulos'],
                'linha3' => $dadosRecuperados['presidios'],
                'linha4' => $dadosRecuperados['enfermos'],
                'linha5' => $dadosRecuperados['hospitais'],
                'linha6' => $dadosRecuperados['escolas'],
                'linha7' => $dadosRecuperados['batismosInfantis'],
                'linha8' => $dadosRecuperados['batismosProfissoes'],
                'linha9' => $dadosRecuperados['bencoesNupciais'],
                'linha10' => $dadosRecuperados['santasCeias'],
                'linha11' => $dadosRecuperados['estudos'],
                'linha12' => $dadosRecuperados['sermoes'],
                'linha13' => $dadosRecuperados['estudosBiblicos'],
                'linha14' => $dadosRecuperados['discipulados'],
                'linha15' => $conteudoMembresia
            ],
        ];

        header( 'Content-type: application/csv' );   
        header( 'Content-Disposition: attachment; filename=Relatorio '.$dadosRecuperados['mes'].'-'.$dadosRecuperados['ano'].'.csv' ); 
        
        // Criar arquivo
        $arquivo = fopen('php://output', 'w');
        
        // Popular os dados
        foreach ($dados as $linha) {
            fputcsv($arquivo, $linha);
        }
        
        fclose($arquivo);
        exit;
    }

    public function montaConteudoMembresiaExcel($dados){
        $content = '';
        foreach($dados['membresias'] as $membro){
            $content .= $membro->nome.": ".$membro->quantidade." pessoas."."\n";
        }   
        return $content;
    }
}
