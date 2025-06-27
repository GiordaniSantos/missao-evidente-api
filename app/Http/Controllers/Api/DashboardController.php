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
use App\Models\Comungante;
use App\Models\SantaCeia;
use App\Models\Estudo;
use App\Models\Sermao;
use App\Models\EstudoBiblico;
use App\Models\Discipulado;
use App\Models\NaoComungante;
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
        $mes = request('mes', date('m'));
        $ano = request('ano', date('Y'));

        $queries = [
            'membresias' => Membresia::query(),
            'crentes' => Crente::query(),
            'incredulos' => Incredulo::query(),
            'presidios' => Presidio::query(),
            'enfermos' => Enfermo::query(),
            'hospitais' => Hospital::query(),
            'escolas' => Escola::query(),
            'batismosInfantis' => BatismoInfantil::query(),
            'batismosProfissoes' => BatismoProfissao::query(),
            'bencoesNupciais' => BencaoNupcial::query(),
            'santasCeias' => SantaCeia::query(),
            'estudos' => Estudo::query(),
            'sermoes' => Sermao::query(),
            'estudosBiblicos' => EstudoBiblico::query(),
            'discipulados' => Discipulado::query()
        ];
        
        foreach ($queries as $key => $query) {
            $query->where('id_usuario', $id_usuario);
            $query->whereYear('created_at', '=', $ano);
            $query->whereMonth('created_at', '=', $mes);
        }
    
        $results = [];
        foreach ($queries as $key => $query) {
            if ($key === 'membresias') {
                $results[$key] = $query->get();
            } else {
                $results[$key] = $query->count();
            }
        }
    
        $comungante = Comungante::query()->select('quantidade')->where('id_usuario', $id_usuario)->first();
        $results['comungante'] = $comungante && $comungante->quantidade ? $comungante->quantidade : 0;
    
        $naoComungante = NaoComungante::query()->select('quantidade')->where('id_usuario', $id_usuario)->first();
        $results['naoComungante'] = $naoComungante && $naoComungante->quantidade ? $naoComungante->quantidade : 0;
    
        return response()->json($results, 200);  
    }

    public function relatorioAnual()
    {
        $id_usuario = request('id_usuario');
        $ano = request('ano', date('Y'));

        $queries = [
            'crentes' => Crente::query(),
            'incredulos' => Incredulo::query(),
            'presidios' => Presidio::query(),
            'enfermos' => Enfermo::query(),
            'hospitais' => Hospital::query(),
            'escolas' => Escola::query(),
            'batismosInfantis' => BatismoInfantil::query(),
            'batismosProfissoes' => BatismoProfissao::query(),
            'bencoesNupciais' => BencaoNupcial::query(),
            'santasCeias' => SantaCeia::query(),
            'estudos' => Estudo::query(),
            'sermoes' => Sermao::query(),
            'estudosBiblicos' => EstudoBiblico::query(),
            'discipulados' => Discipulado::query()
        ];
        
        foreach ($queries as $key => $query) {
            $query->where('id_usuario', $id_usuario);
            $query->whereYear('created_at', '=', $ano);
        }
    
        $results = [];
        foreach ($queries as $key => $query) {
            $results[$key] = $query->count();
        }

        $membresias = DB::table('membresias')
        ->where('id_usuario', $id_usuario)
        ->whereYear('created_at', '=', $ano)
        ->select(\DB::raw("SUM(quantidade) as total"))
        ->get();
        $membresiasTotal = Membresia::where('id_usuario', $id_usuario)->whereYear('created_at', '=', $ano)->count();
        $results['membresias'] = $membresiasTotal != 0 ? intval($membresias[0]->total / $membresiasTotal) : 0;
    
        return response()->json($results, 200);  
    }

}