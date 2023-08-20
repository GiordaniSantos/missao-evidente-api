<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AtoListResource;
use App\Http\Resources\AtoResource;
use App\Models\Ato;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class AtoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = request('id_usuario');
        $query = Ato::query()
            ->where('id_usuario', $id_usuario)
            ->orderBy('created_at', 'desc')
            ->take(15)
            ->get();

        return AtoListResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Ato::rules(), Ato::feedback());
        $ato = new Ato();
        $ato->nome = $request->input('nome');
        $ato->quantidade = $request->input('quantidade');
        $ato->id_usuario = $request->input('id_usuario');

        $ato->save();

        return response()->json($ato, 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Ato $ato
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_usuario = request('id_usuario');
        $ato = Ato::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($ato === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        $ato->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}