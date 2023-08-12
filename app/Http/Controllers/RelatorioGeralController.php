<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
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

class RelatorioGeralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $membresias = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $membresiasTotal = Membresia::where('id_usuario', \Auth::user()->id)->count();
        if($membresias[0]->total){
            $mediaMembresias = $membresias[0]->total / $membresiasTotal;
        }else{
            $mediaMembresias = 0;
        }

        $atos = DB::table('atos')
        ->where('id_usuario', \Auth::user()->id)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $atosTotal = Ato::where('id_usuario', \Auth::user()->id)->count();
        if($atos[0]->total){
            $mediaAtos = $atos[0]->total / $atosTotal;
        }else{
            $mediaAtos = 0;
        }

        $pregacoes = DB::table('pregacaos')
        ->where('id_usuario', \Auth::user()->id)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $pregacoesTotal = Pregacao::where('id_usuario', \Auth::user()->id)->count();
        if($pregacoes[0]->total){
            $mediaPregacoes = $pregacoes[0]->total / $pregacoesTotal;
        }else{
            $mediaPregacoes = 0;
        }

        $crentes = Crente::where('id_usuario', \Auth::user()->id)->count();
        $incredulos = Incredulo::where('id_usuario', \Auth::user()->id)->count();
        $presidios = Presidio::where('id_usuario', \Auth::user()->id)->count();
        $enfermos = Enfermo::where('id_usuario', \Auth::user()->id)->count();
        $hospitais = Hospital::where('id_usuario', \Auth::user()->id)->count();
        $escolas = Escola::where('id_usuario', \Auth::user()->id)->count();

        return view('admin.relatorios-gerais.index', [
            'mediaMembresias' => $mediaMembresias,
            'mediaAtos' => $mediaAtos,
            'mediaPregacoes' => $mediaPregacoes,
            'crentes' => $crentes,
            'incredulos' => $incredulos,
            'presidios' => $presidios,
            'enfermos' => $enfermos,
            'hospitais' => $hospitais,
            'escolas' => $escolas 
        ]);
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

    public function dadosMembresia()
    {
        $jan = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 1)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $janTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 1)->count();
        if($jan[0]->total){
            $mediaJan = $jan[0]->total / $janTotal;
        }else{
            $mediaJan = 0;
        }

        $fev = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 2)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $fevTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 2)->count();
        if($fev[0]->total){
            $mediaFev = $fev[0]->total / $fevTotal;
        }else{
            $mediaFev = 0;
        }

        $mar = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 3)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $marTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 3)->count();
        if($mar[0]->total){
            $mediaMar = $mar[0]->total / $marTotal;
        }else{
            $mediaMar = 0;
        }

        $abr = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 4)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $abrTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 4)->count();
        if($abr[0]->total){
            $mediaAbr = $abr[0]->total / $abrTotal;
        }else{
            $mediaAbr = 0;
        }

        $mai = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 5)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $maiTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 5)->count();
        if($mai[0]->total){
            $mediaMai = $mai[0]->total / $maiTotal;
        }else{
            $mediaMai = 0;
        }

        $jun = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 6)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $junTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 6)->count();
        if($jun[0]->total){
            $mediaJun = $jun[0]->total / $junTotal;
        }else{
            $mediaJun = 0;
        }

        $jul = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 7)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $julTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 7)->count();
        if($jul[0]->total){
            $mediaJul = $jul[0]->total / $julTotal;
        }else{
            $mediaJul = 0;
        }

        $ago = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 8)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $agoTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 8)->count();
        if($ago[0]->total){
            $mediaAgo = $ago[0]->total / $agoTotal;
        }else{
            $mediaAgo = 0;
        }

        $set = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 9)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $setTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 9)->count();
        if($set[0]->total){
            $mediaSet = $set[0]->total / $setTotal;
        }else{
            $mediaSet = 0;
        }

        $out = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 10)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $outTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 10)->count();
        if($out[0]->total){
            $mediaOut = $out[0]->total / $outTotal;
        }else{
            $mediaOut = 0;
        }

        $nov = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 11)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $novTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 11)->count();
        if($nov[0]->total){
            $mediaNov = $nov[0]->total / $novTotal;
        }else{
            $mediaNov = 0;
        }

        $dez = DB::table('membresias')
        ->where('id_usuario', \Auth::user()->id)
        ->whereMonth('created_at', '=', 12)
        ->select( \DB::raw("SUM(quantidade) as total"))
        ->get();
        $dezTotal = Membresia::where('id_usuario', \Auth::user()->id)->whereMonth('created_at', '=', 12)->count();
        if($dez[0]->total){
            $mediaDez = $dez[0]->total / $dezTotal;
        }else{
            $mediaDez = 0;
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
