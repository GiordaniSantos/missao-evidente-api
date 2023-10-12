<?php

namespace App\Http\Controllers;

use App\Models\SantaCeia;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SantaCeiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $santasCeias = SantaCeia::orderBy('created_at', 'desc')->where('id_usuario', \Auth::user()->id)->get();

        $title = 'Deletar registro de Santa Ceia!';
        $text = "Você tem certeza que quer deletar este registro?";
        confirmDelete($title, $text);
        return view('admin.santa-ceia.index', ['santasCeias' => $santasCeias]);
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
            $request->validate(SantaCeia::rules(), SantaCeia::feedback());
            $santaCeia = new SantaCeia();
            $santaCeia->id_usuario = \Auth::user()->id;
            if($santaCeia->save()){
                alert()->success('Concluído','Registro adicionado com sucesso.');
            }
        }
        return redirect()->route('santa-ceia.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SantaCeia $santaCeia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $santaCeia = SantaCeia::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$santaCeia){
            abort(404, 'Registro não encotrado!');
        }
        return view('admin.santa-ceia.edit', ['santaCeia' => $santaCeia]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $santaCeia = SantaCeia::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$santaCeia){
            abort(404, 'Registro não encotrado!');
        }
        if($request->input('_token') != '' && $request->input('id') == ''){

            //validacao
            $request->validate(SantaCeia::rules(), SantaCeia::feedback());
            $santaCeia->id_usuario = \Auth::user()->id;
            if($santaCeia->update($request->all())){
                alert()->success('Concluído','Registro atualizado com sucesso.');
            }else{
                alert()->error('ErrorAlert','Erro na atualização do registro.');
            }
        }
        
        return redirect()->route('santa-ceia.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $santaCeia = SantaCeia::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$santaCeia){
            abort(404, 'Registro não encotrado!');
        }
        $santaCeia->delete();

        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('santa-ceia.index');
    }
}
