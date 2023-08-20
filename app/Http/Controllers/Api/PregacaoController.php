<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PregacaoListResource;
use App\Models\Pregacao;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class PregacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = request('id_usuario');
        $query = Pregacao::query()
            ->where('id_usuario', $id_usuario)
            ->orderBy('created_at', 'desc')
            ->take(15)
            ->get();

        return PregacaoListResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Pregacao::rules(), Pregacao::feedback());
        $pregacao = new Pregacao();
        $pregacao->nome = $request->input('nome');
        $pregacao->quantidade = $request->input('quantidade');
        $pregacao->id_usuario = $request->input('id_usuario');

        $pregacao->save();

        return response()->json($pregacao, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Pregacao $pregacao
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_usuario = request('id_usuario');
        $pregacao = Pregacao::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($pregacao === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        $pregacao->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}