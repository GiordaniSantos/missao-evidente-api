<?php

namespace App\Http\Controllers;

use App\Models\Sermao;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SermaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sermoes = Sermao::orderBy('created_at', 'desc')->where('id_usuario', \Auth::user()->id)->get();

        $title = 'Deletar registro de Sermão!';
        $text = "Você tem certeza que quer deletar este registro?";
        confirmDelete($title, $text);
        return view('admin.sermao.index', ['sermoes' => $sermoes]);
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
            $request->validate(Sermao::rules(), Sermao::feedback());
            $sermao = new Sermao();
            $sermao->id_usuario = \Auth::user()->id;
            if($sermao->save()){
                alert()->success('Concluído','Registro adicionado com sucesso.');
            }
        }
        return redirect()->route('sermao.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sermao $sermao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sermao = sermao::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$sermao){
            abort(404, 'Registro não encotrado!');
        }
        return view('admin.sermao.edit', ['sermao' => $sermao]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sermao = Sermao::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$sermao){
            abort(404, 'Registro não encotrado!');
        }
        if($request->input('_token') != '' && $request->input('id') == ''){

            //validacao
            $request->validate(Sermao::rules(), Sermao::feedback());
            $sermao->id_usuario = \Auth::user()->id;
            if($sermao->update($request->all())){
                alert()->success('Concluído','Registro atualizado com sucesso.');
            }else{
                alert()->error('ErrorAlert','Erro na atualização do registro.');
            }
        }
        
        return redirect()->route('sermao.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sermao = Sermao::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$sermao){
            abort(404, 'Registro não encotrado!');
        }
        $sermao->delete();

        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('sermao.index');
    }
}
