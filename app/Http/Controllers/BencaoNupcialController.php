<?php

namespace App\Http\Controllers;

use App\Models\BencaoNupcial;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BencaoNupcialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bencoesNupciais = BencaoNupcial::orderBy('created_at', 'desc')->where('id_usuario', \Auth::user()->id)->get();

        $title = 'Deletar registro de Benção Nupcial!';
        $text = "Você tem certeza que quer deletar este registro?";
        confirmDelete($title, $text);
        return view('admin.bencao-nupcial.index', ['bencoesNupciais' => $bencoesNupciais]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->input('_token') != '' && $request->input('id') == ''){
            //validacao
            $request->validate(BencaoNupcial::rules(), BencaoNupcial::feedback());
            $bencaoNupcial = new BencaoNupcial();
            $bencaoNupcial->id_usuario = \Auth::user()->id;
            if($bencaoNupcial->save()){
                alert()->success('Concluído','Registro adicionado com sucesso.');
            }
        }
        return redirect()->route('bencao-nupcial.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(BencaoNupcial $bencaoNupcial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bencaoNupcial = BencaoNupcial::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$bencaoNupcial){
            abort(404, 'Registro não encotrado!');
        }
        return view('admin.bencao-nupcial.edit', ['bencaoNupcial' => $bencaoNupcial]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $bencaoNupcial = BencaoNupcial::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$bencaoNupcial){
            abort(404, 'Registro não encotrado!');
        }
        if($request->input('_token') != '' && $request->input('id') == ''){

            //validacao
            $request->validate(BencaoNupcial::rules(), BencaoNupcial::feedback());
            $bencaoNupcial->id_usuario = \Auth::user()->id;
            if($bencaoNupcial->update($request->all())){
                alert()->success('Concluído','Registro atualizado com sucesso.');
            }else{
                alert()->error('ErrorAlert','Erro na atualização do registro.');
            }
        }
        
        return redirect()->route('bencao-nupcial.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bencaoNupcial = BencaoNupcial::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$bencaoNupcial){
            abort(404, 'Registro não encotrado!');
        }
        $bencaoNupcial->delete();

        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('bencao-nupcial.index');
    }
}
