<?php

namespace App\Http\Controllers;

use App\Models\BatismoProfissao;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BatismoProfissaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batismosProfissoes = BatismoProfissao::orderBy('created_at', 'desc')->where('id_usuario', \Auth::user()->id)->get();

        $title = 'Deletar registro de Batismo/Profissão de Fé!';
        $text = "Você tem certeza que quer deletar este registro?";
        confirmDelete($title, $text);
        return view('admin.batismo-profissao.index', ['batismosProfissoes' => $batismosProfissoes]);
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
            $request->validate(BatismoProfissao::rules(), BatismoProfissao::feedback());
            $batismoProfissao = new BatismoProfissao();
            $batismoProfissao->id_usuario = \Auth::user()->id;
            if($batismoProfissao->save()){
                alert()->success('Concluído','Registro adicionado com sucesso.');
            }
        }
        return redirect()->route('batismo-profissao.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(BatismoProfissao $batismoProfissao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $batismoProfissao = BatismoProfissao::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$batismoProfissao){
            abort(404, 'Registro não encotrado!');
        }
        return view('admin.batismo-profissao.edit', ['batismoProfissao' => $batismoProfissao]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $batismoProfissao = BatismoProfissao::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$batismoProfissao){
            abort(404, 'Registro não encotrado!');
        }
        if($request->input('_token') != '' && $request->input('id') == ''){

            //validacao
            $request->validate(BatismoProfissao::rules(), BatismoProfissao::feedback());
            $batismoProfissao->id_usuario = \Auth::user()->id;
            if($batismoProfissao->update($request->all())){
                alert()->success('Concluído','Registro atualizado com sucesso.');
            }else{
                alert()->error('ErrorAlert','Erro na atualização do registro.');
            }
        }
        
        return redirect()->route('batismo-profissao.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $batismoProfissao = BatismoProfissao::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$batismoProfissao){
            abort(404, 'Registro não encotrado!');
        }
        $batismoProfissao->delete();

        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('batismo-profissao.index');
    }
}
