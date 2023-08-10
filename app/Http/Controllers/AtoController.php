<?php

namespace App\Http\Controllers;

use App\Models\Ato;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AtoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $atos = Ato::orderBy('id', 'desc')->where('id_usuario', \Auth::user()->id)->get();

        $title = 'Deletar ato pastoral!';
        $text = "Você tem certeza que quer deletar este registro?";
        confirmDelete($title, $text);
        return view('admin.atos-pastorais.index', ['atos' => $atos, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.atos-pastorais.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->input('_token') != '' && $request->input('id') == ''){
            //validacao
            $request->validate(Ato::rules(), Ato::feedback());
            $ato = new Ato();
            $ato->nome = $request->input('nome');
            $ato->quantidade = $request->input('quantidade');
            $ato->id_usuario = \Auth::user()->id;
            if($ato->save()){
                alert()->success('Concluído','Registro adicionado com sucesso.');
            }
        }
        return redirect()->route('atos-pastorais.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ato $ato)
    {
        return view('admin.atos-pastorais.show', ['ato' => $ato]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ato $atos_pastorai)
    {
        return view('admin.atos-pastorais.edit', ['ato' => $atos_pastorai]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ato $ato)
    {
        if($request->input('_token') != '' && $request->input('id') == ''){

            //validacao
            $request->validate(Ato::rules(), Ato::feedback());
            $ato->id_usuario = \Auth::user()->id;
            if($ato->update($request->all())){
                alert()->success('Concluído','Registro atualizado com sucesso.');
            }else{
                alert()->error('ErrorAlert','Erro na atualização do registro.');
            }
        }
        
        return redirect()->route('atos-pastorais.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ato $ato)
    {
        $ato->delete();

        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('atos-pastorais.index');
    }
}
