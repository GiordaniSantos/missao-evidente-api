<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonListResource;
use App\Models\Enfermo;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class EnfermoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = request('id_usuario');
        $query = Enfermo::query()
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
        $request->validate(Enfermo::rules(), Enfermo::feedback());
        $enfermo = new Enfermo();
        $enfermo->id_usuario = $request->input('id_usuario');
        $enfermo->save();

        return response()->json($enfermo, 201);
    }

       /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enfermo  $enfermo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id_usuario = request('id_usuario');
        $enfermo = Enfermo::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($enfermo === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        return response()->json($enfermo, 200);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enfermo  $enfermo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id_usuario = request('id_usuario');
        $enfermo = Enfermo::where('id', $id)->where('id_usuario', $id_usuario)->first();
        $request->validate(Enfermo::rules(), Enfermo::feedback());
        $enfermo->id_usuario = $id_usuario;
        $enfermo->created_at = Carbon::parse($request->created_at)->setTimezone('America/Sao_Paulo');
        $enfermo->save();

        return response()->json($enfermo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Enfermo $enfermo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_usuario = request('id_usuario');
        $enfermo = Enfermo::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($enfermo === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        $enfermo->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}