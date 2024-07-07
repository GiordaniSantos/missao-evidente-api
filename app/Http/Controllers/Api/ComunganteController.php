<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FrequenciaListResource;
use App\Models\Comungante;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ComunganteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = request('id_usuario');
        $query = Comungante::query()
            ->where('id_usuario', $id_usuario)
            ->orderBy('created_at', 'desc');

        return $query->first();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Comungante::rules(), Comungante::feedback());
        $comungante = new Comungante();
        $comungante->quantidade = $request->input('quantidade');
        $comungante->id_usuario = $request->input('id_usuario');
        $comungante->save();

        return response()->json($comungante, 201);
    }

       /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comungante  $comungante
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id_usuario = request('id_usuario');
        $comungante = Comungante::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($comungante === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        return response()->json($comungante, 200);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comungante  $comungante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id_usuario = request('id_usuario');
        $comungante = Comungante::where('id', $id)->where('id_usuario', $id_usuario)->first();
        $request->validate(Comungante::rules(), Comungante::feedback());
        $comungante->id_usuario = $id_usuario;
        $comungante->quantidade = $request->quantidade;
        $comungante->created_at = Carbon::parse($request->created_at)->setTimezone('America/Sao_Paulo');
        $comungante->save();

        return response()->json($comungante, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Comungante $comungante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_usuario = request('id_usuario');
        $comungante = Comungante::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($comungante === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        $comungante->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}