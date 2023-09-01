<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonListResource;
use App\Models\EstudoBiblico;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class EstudoBiblicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = request('id_usuario');
        $query = EstudoBiblico::query()
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
        $request->validate(EstudoBiblico::rules(), EstudoBiblico::feedback());
        $estudobiblico = new EstudoBiblico();
        $estudobiblico->id_usuario = $request->input('id_usuario');
        $estudobiblico->save();

        return response()->json($estudobiblico, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\EstudoBiblico $estudobiblico
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_usuario = request('id_usuario');
        $estudobiblico = EstudoBiblico::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($estudobiblico === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        $estudobiblico->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}