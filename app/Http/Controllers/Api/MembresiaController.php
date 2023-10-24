<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MembresiaListResource;
use App\Models\Membresia;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class MembresiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = request('id_usuario');
        $query = Membresia::query()
            ->where('id_usuario', $id_usuario)
            ->orderBy('created_at', 'desc')
            ->take(15)
            ->get();

        return MembresiaListResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Membresia::rules(), Membresia::feedback());
        $membresia = new Membresia();
        $membresia->nome = $request->input('nome');
        $membresia->quantidade = $request->input('quantidade');
        $membresia->id_usuario = $request->input('id_usuario');

        $membresia->save();

        return response()->json($membresia, 201);
    }

      /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membresia  $membresia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id_usuario = request('id_usuario');
        $membresia = Membresia::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($membresia === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        return response()->json($membresia, 200);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Membresia  $membresia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id_usuario = request('id_usuario');
        $membresia = Membresia::where('id', $id)->where('id_usuario', $id_usuario)->first();
        $request->validate(Membresia::rules(), Membresia::feedback());
        $membresia->id_usuario = $id_usuario;
        $membresia->created_at = Carbon::parse($request->created_at)->setTimezone('America/Sao_Paulo');
        $membresia->fill($request->all());
        $membresia->save();

        return response()->json($membresia, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Membresia $membresia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_usuario = request('id_usuario');
        $membresia = Membresia::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($membresia === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        $membresia->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}