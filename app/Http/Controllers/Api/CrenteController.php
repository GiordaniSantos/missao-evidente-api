<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonListResource;
use App\Models\Crente;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CrenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = request('id_usuario');
        $query = Crente::query()
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
        $request->validate(Crente::rules(), Crente::feedback());
        $crente = new Crente();
        $crente->id_usuario = $request->input('id_usuario');
        $crente->save();

        return response()->json($crente, 201);
    }

       /**
     * Display the specified resource.
     *
     * @param  \App\Models\Crente  $crente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id_usuario = request('id_usuario');
        $crente = Crente::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($crente === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        return response()->json($crente, 200);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Crente  $crente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id_usuario = request('id_usuario');
        $crente = Crente::where('id', $id)->where('id_usuario', $id_usuario)->first();
        $request->validate(Crente::rules(), Crente::feedback());
        $crente->id_usuario = $id_usuario;
        $crente->created_at = Carbon::parse($request->created_at)->setTimezone('America/Sao_Paulo');
        $crente->save();

        return response()->json($crente, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Crente $crente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_usuario = request('id_usuario');
        $crente = Crente::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($crente === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        $crente->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}