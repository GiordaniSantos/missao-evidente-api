<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonListResource;
use App\Models\Estudo;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EstudoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = request('id_usuario');
        $query = Estudo::query()
            ->where('id_usuario', $id_usuario)
            ->orderBy('created_at', 'desc')
            ->take(15)
            ->get();

        return CommonListResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Estudo::rules(), Estudo::feedback());
        $estudo = new Estudo();
        $estudo->id_usuario = $request->input('id_usuario');
        $estudo->save();

        return response()->json($estudo, 201);
    }

      /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estudo  $estudo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id_usuario = request('id_usuario');
        $estudo = Estudo::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($estudo === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        return response()->json($estudo, 200);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estudo  $estudo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id_usuario = request('id_usuario');
        $estudo = Estudo::where('id', $id)->where('id_usuario', $id_usuario)->first();
        //dd($request->all());
        //dd(Carbon::parse($request->created_at)->setTimezone('America/Sao_Paulo'));
        $request->validate(Estudo::rules(), Estudo::feedback());
        $estudo->id_usuario = $id_usuario;
        $estudo->nome = $request->nome;
        $estudo->created_at = Carbon::parse($request->created_at)->setTimezone('America/Sao_Paulo');
        $estudo->save();
        //dd($estudo->created_at);

        return response()->json($estudo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Estudo $estudo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_usuario = request('id_usuario');
        $estudo = Estudo::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($estudo === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        $estudo->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}