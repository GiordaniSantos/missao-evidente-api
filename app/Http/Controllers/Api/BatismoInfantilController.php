<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonListResource;
use App\Models\BatismoInfantil;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class BatismoInfantilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = request('id_usuario');
        $query = BatismoInfantil::query()
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
        $request->validate(BatismoInfantil::rules(), BatismoInfantil::feedback());
        $batismoinfantil = new BatismoInfantil();
        $batismoinfantil->id_usuario = $request->input('id_usuario');
        $batismoinfantil->save();

        return response()->json($batismoinfantil, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BatismoInfantil $batismoinfantil
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_usuario = request('id_usuario');
        $batismoinfantil = BatismoInfantil::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($batismoinfantil === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        $batismoinfantil->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}