<?php

namespace App\Http\Controllers;

use App\Models\Pregacao;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PregacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pregacoes = Pregacao::orderBy('id', 'desc')->where('id_usuario', \Auth::user()->id)->get();

        $title = 'Deletar dado de pregação!';
        $text = "Você tem certeza que quer deletar este registro?";
        confirmDelete($title, $text);
        return view('admin.pregacao.index', ['pregacoes' => $pregacoes, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pregacao.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->input('_token') != '' && $request->input('id') == ''){
            //validacao
            $request->validate(Pregacao::rules(), Pregacao::feedback());
            $pregacao = new Pregacao();
            $pregacao->nome = $request->input('nome');
            $pregacao->quantidade = $request->input('quantidade');
            $pregacao->id_usuario = \Auth::user()->id;
            if($pregacao->save()){
                alert()->success('Concluído','Registro adicionado com sucesso.');
            }
        }
        return redirect()->route('pregacao.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pregacao $pregacao)
    {
        return view('admin.pregacao.show', ['pregacao' => $pregacao]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pregacao $pregacao)
    {
        return view('admin.pregacao.edit', ['pregacao' => $pregacao]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pregacao $pregacao)
    {
        if($request->input('_token') != '' && $request->input('id') == ''){

            //validacao
            $request->validate(Pregacao::rules(), Pregacao::feedback());
            $pregacao->id_usuario = \Auth::user()->id;
            if($pregacao->update($request->all())){
                alert()->success('Concluído','Registro atualizado com sucesso.');
            }else{
                alert()->error('ErrorAlert','Erro na atualização do registro.');
            }
        }
        
        return redirect()->route('pregacao.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pregacao $pregacao)
    {
        $pregacao->delete();

        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('atos-pastorais.index');
    }
}
