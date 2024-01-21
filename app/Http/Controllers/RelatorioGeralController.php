<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
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

class RelatorioGeralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.relatorios-gerais.index', $this->getDados());
    }

    public function getDados(){
        $membresias = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $membresiasTotal = Membresia::where('id_usuario', \Auth::user()->id)->count();

        $mediaMembresias = 0;
        if($membresias[0]->total){
            $mediaMembresias = $membresias[0]->total / $membresiasTotal;
        }

        $crentes = Crente::where('id_usuario', \Auth::user()->id)->count();
        $incredulos = Incredulo::where('id_usuario', \Auth::user()->id)->count();
        $presidios = Presidio::where('id_usuario', \Auth::user()->id)->count();
        $enfermos = Enfermo::where('id_usuario', \Auth::user()->id)->count();
        $hospitais = Hospital::where('id_usuario', \Auth::user()->id)->count();
        $escolas = Escola::where('id_usuario', \Auth::user()->id)->count();
        $batismosInfantis = BatismoInfantil::where('id_usuario', \Auth::user()->id)->count();
        $batismosProfissoes = BatismoProfissao::where('id_usuario', \Auth::user()->id)->count();
        $bencoesNupciais = BencaoNupcial::where('id_usuario', \Auth::user()->id)->count();
        $santasCeias = SantaCeia::where('id_usuario', \Auth::user()->id)->count();
        $estudos = Estudo::where('id_usuario', \Auth::user()->id)->count();
        $sermoes = Sermao::where('id_usuario', \Auth::user()->id)->count();
        $estudosBiblicos = EstudoBiblico::where('id_usuario', \Auth::user()->id)->count();
        $discipulados = Discipulado::where('id_usuario', \Auth::user()->id)->count();

        return  [
            'mediaMembresias' => $mediaMembresias,
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
            'discipulados' => $discipulados
        ];
    }

    public function exportExcel(){

        $dadosRecuperados = $this->getDados();

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
                'coluna15' => 'Média de Membros/Domingo'
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
                'linha15' => intval($dadosRecuperados['mediaMembresias'])
            ],
        ];

        header( 'Content-type: application/csv' );   
        header( 'Content-Disposition: attachment; filename=Relatorio Geral.csv' ); 
        
        // Criar arquivo
        $arquivo = fopen('php://output', 'w');
        
        // Popular os dados
        foreach ($dados as $linha) {
            fputcsv($arquivo, $linha);
        }
        
        fclose($arquivo);
        exit;
    }

    public function dadosVisitacao()
    {
        $crentes = Crente::where('id_usuario', \Auth::user()->id)->count();
        $incredulos = Incredulo::where('id_usuario', \Auth::user()->id)->count();
        $presidios = Presidio::where('id_usuario', \Auth::user()->id)->count();
        $enfermos = Enfermo::where('id_usuario', \Auth::user()->id)->count();
        $hospitais = Hospital::where('id_usuario', \Auth::user()->id)->count();
        $escolas = Escola::where('id_usuario', \Auth::user()->id)->count();

        $dados = [
            $crentes,
            $incredulos,
            $presidios,
            $enfermos,
            $hospitais,
            $escolas
        ];

        return response()->json($dados, 200);
    }

    public function dadosAtosPastorais()
    {
        $batismosInfantis = BatismoInfantil::where('id_usuario', \Auth::user()->id)->count();
        $batismosProfissoes = BatismoProfissao::where('id_usuario', \Auth::user()->id)->count();
        $bencoesNupciais = BencaoNupcial::where('id_usuario', \Auth::user()->id)->count();
        $santasCeias = SantaCeia::where('id_usuario', \Auth::user()->id)->count();

        $dados = [
            $batismosInfantis,
            $batismosProfissoes,
            $bencoesNupciais,
            $santasCeias
        ];

        return response()->json($dados, 200);
    }

    public function dadosPregacao()
    {
        $estudos = Estudo::where('id_usuario', \Auth::user()->id)->count();
        $sermoes = Sermao::where('id_usuario', \Auth::user()->id)->count();
        $estudosBiblicos = EstudoBiblico::where('id_usuario', \Auth::user()->id)->count();
        $discipulados = Discipulado::where('id_usuario', \Auth::user()->id)->count();

        $dados = [
            $estudos,
            $sermoes,
            $estudosBiblicos,
            $discipulados
        ];

        return response()->json($dados, 200);
    }

    public function dadosMembresia()
    {
        $jan = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 1)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $janTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 1)->count();

        $mediaJan = 0;
        if($jan[0]->total){
            $mediaJan = $jan[0]->total / $janTotal;
        }

        $fev = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 2)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $fevTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 2)->count();
        $mediaFev = 0;
        if($fev[0]->total){
            $mediaFev = $fev[0]->total / $fevTotal;
        }

        $mar = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 3)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $marTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 3)->count();
        $mediaMar = 0;
        if($mar[0]->total){
            $mediaMar = $mar[0]->total / $marTotal;
        }

        $abr = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 4)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $abrTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 4)->count();
        $mediaAbr = 0;
        if($abr[0]->total){
            $mediaAbr = $abr[0]->total / $abrTotal;
        }

        $mai = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 5)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $maiTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 5)->count();
        $mediaMai = 0;
        if($mai[0]->total){
            $mediaMai = $mai[0]->total / $maiTotal;
        }

        $jun = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 6)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $junTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 6)->count();
        $mediaJun = 0;
        if($jun[0]->total){
            $mediaJun = $jun[0]->total / $junTotal;
        }

        $jul = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 7)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $julTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 7)->count();
        $mediaJul = 0;
        if($jul[0]->total){
            $mediaJul = $jul[0]->total / $julTotal;
        }

        $ago = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 8)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $agoTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 8)->count();
        $mediaAgo = 0;
        if($ago[0]->total){
            $mediaAgo = $ago[0]->total / $agoTotal;
        }

        $set = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 9)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $setTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 9)->count();
        $mediaSet = 0;
        if($set[0]->total){
            $mediaSet = $set[0]->total / $setTotal;
        }

        $out = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 10)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $outTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 10)->count();
        $mediaOut = 0;
        if($out[0]->total){
            $mediaOut = $out[0]->total / $outTotal;
        }

        $nov = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 11)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $novTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 11)->count();
        $mediaNov = 0;
        if($nov[0]->total){
            $mediaNov = $nov[0]->total / $novTotal;
        }

        $dez = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 12)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $dezTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 12)->count();
        $mediaDez = 0;
        if($dez[0]->total){
            $mediaDez = $dez[0]->total / $dezTotal;
        }
        
        $dados = [
            $mediaJan,
            $mediaFev,
            $mediaMar,
            $mediaAbr,
            $mediaMai,
            $mediaJun,
            $mediaJul,
            $mediaAgo,
            $mediaSet,
            $mediaOut,
            $mediaNov,
            $mediaDez
        ];
        
        return response()->json($dados, 200);
    }

}
