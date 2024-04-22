<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonListResource;
use App\Models\Escola;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EscolaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = request('id_usuario');
        $query = Escola::query()
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
        $request->validate(Escola::rules(), Escola::feedback());
        $escola = new Escola();
        $escola->id_usuario = $request->input('id_usuario');
        $escola->save();

        return response()->json($escola, 201);
    }

       /**
     * Display the specified resource.
     *
     * @param  \App\Models\Escola  $escola
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id_usuario = request('id_usuario');
        $escola = Escola::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($escola === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        return response()->json($escola, 200);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Escola  $escola
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id_usuario = request('id_usuario');
        $escola = Escola::where('id', $id)->where('id_usuario', $id_usuario)->first();
        //dd($request->all());
        //dd(Carbon::parse($request->created_at)->setTimezone('America/Sao_Paulo'));
        $request->validate(Escola::rules(), Escola::feedback());
        $escola->id_usuario = $id_usuario;
        $escola->nome = $request->nome;
        $escola->created_at = Carbon::parse($request->created_at)->setTimezone('America/Sao_Paulo');
        $escola->save();
        //dd($escola->created_at);

        return response()->json($escola, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Escola $escola
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_usuario = request('id_usuario');
        $escola = Escola::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($escola === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        $escola->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}