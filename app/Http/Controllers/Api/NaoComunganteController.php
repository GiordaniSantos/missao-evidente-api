<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FrequenciaListResource;
use App\Models\NaoComungante;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NaoComunganteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = request('id_usuario');
        $query = NaoComungante::query()
            ->where('id_usuario', $id_usuario)
            ->orderBy('created_at', 'desc')
            ->take(15)
            ->get();

        return FrequenciaListResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(NaoComungante::rules(), NaoComungante::feedback());
        $naocomungante = new NaoComungante();
        $naocomungante->id_usuario = $request->input('id_usuario');
        $naocomungante->save();

        return response()->json($naocomungante, 201);
    }

       /**
     * Display the specified resource.
     *
     * @param  \App\Models\NaoComungante  $naocomungante
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id_usuario = request('id_usuario');
        $naocomungante = NaoComungante::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($naocomungante === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        return response()->json($naocomungante, 200);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NaoComungante  $naocomungante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id_usuario = request('id_usuario');
        $naocomungante = NaoComungante::where('id', $id)->where('id_usuario', $id_usuario)->first();
        $request->validate(NaoComungante::rules(), NaoComungante::feedback());
        $naocomungante->id_usuario = $id_usuario;
        $naocomungante->quantidade = $request->quantidade;
        $naocomungante->created_at = Carbon::parse($request->created_at)->setTimezone('America/Sao_Paulo');
        $naocomungante->save();

        return response()->json($naocomungante, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\NaoComungante $naocomungante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_usuario = request('id_usuario');
        $naocomungante = NaoComungante::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($naocomungante === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        $naocomungante->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}