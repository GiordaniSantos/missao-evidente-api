<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonListResource;
use App\Models\BatismoProfissao;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class BatismoProfissaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = request('id_usuario');
        $query = BatismoProfissao::query()
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
        $request->validate(BatismoProfissao::rules(), BatismoProfissao::feedback());
        $batismoprofissao = new BatismoProfissao();
        $batismoprofissao->id_usuario = $request->input('id_usuario');
        $batismoprofissao->save();

        return response()->json($batismoprofissao, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BatismoProfissao $batismoprofissao
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_usuario = request('id_usuario');
        $batismoprofissao = BatismoProfissao::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($batismoprofissao === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        $batismoprofissao->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}