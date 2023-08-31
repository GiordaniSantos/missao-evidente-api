<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonListResource;
use App\Models\SantaCeia;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class SantaCeiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = request('id_usuario');
        $query = SantaCeia::query()
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
        $request->validate(SantaCeia::rules(), SantaCeia::feedback());
        $santaceia = new SantaCeia();
        $santaceia->id_usuario = $request->input('id_usuario');
        $santaceia->save();

        return response()->json($santaceia, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SantaCeia $santaceia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_usuario = request('id_usuario');
        $santaceia = SantaCeia::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($santaceia === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        $santaceia->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}