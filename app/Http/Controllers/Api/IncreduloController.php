<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\IncreduloListResource;
use App\Models\Incredulo;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class IncreduloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = request('id_usuario');
        $query = Incredulo::query()
            ->where('id_usuario', $id_usuario)
            ->orderBy('created_at', 'desc')
            ->take(15)
            ->get();

        return IncreduloListResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Incredulo::rules(), Incredulo::feedback());
        $incredulo = new Incredulo();
        $incredulo->id_usuario = $request->input('id_usuario');
        $incredulo->save();

        return response()->json($incredulo, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Incredulo $incredulo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_usuario = request('id_usuario');
        $incredulo = Incredulo::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($incredulo === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        $incredulo->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}