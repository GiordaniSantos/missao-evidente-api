<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonListResource;
use App\Models\BencaoNupcial;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class BencaoNupcialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = request('id_usuario');
        $query = BencaoNupcial::query()
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
        $request->validate(BencaoNupcial::rules(), BencaoNupcial::feedback());
        $bencaonupcial = new BencaoNupcial();
        $bencaonupcial->id_usuario = $request->input('id_usuario');
        $bencaonupcial->save();

        return response()->json($bencaonupcial, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BencaoNupcial $bencaonupcial
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_usuario = request('id_usuario');
        $bencaonupcial = BencaoNupcial::where('id', $id)->where('id_usuario', $id_usuario)->first();
        if($bencaonupcial === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe.'], 404);
        }
        $bencaonupcial->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}