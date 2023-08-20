<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EscolaListResource;
use App\Models\Escola;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

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

        return EscolaListResource::collection($query);
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