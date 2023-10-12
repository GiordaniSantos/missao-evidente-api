<?php

namespace App\Http\Controllers;

use App\Models\Estudo;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EstudoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudos = Estudo::orderBy('created_at', 'desc')->where('id_usuario', \Auth::user()->id)->get();

        $title = 'Deletar registro de Estudo!';
        $text = "Você tem certeza que quer deletar este registro?";
        confirmDelete($title, $text);
        return view('admin.estudo.index', ['estudos' => $estudos]);
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
            $request->validate(Estudo::rules(), Estudo::feedback());
            $estudo = new Estudo();
            $estudo->id_usuario = \Auth::user()->id;
            if($estudo->save()){
                alert()->success('Concluído','Registro adicionado com sucesso.');
            }
        }
        return redirect()->route('estudo.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estudo $estudo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $estudo = Estudo::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$estudo){
            abort(404, 'Registro não encotrado!');
        }
        return view('admin.estudo.edit', ['estudo' => $estudo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $estudo = Estudo::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$estudo){
            abort(404, 'Registro não encotrado!');
        }
        if($request->input('_token') != '' && $request->input('id') == ''){

            //validacao
            $request->validate(Estudo::rules(), Estudo::feedback());
            $estudo->id_usuario = \Auth::user()->id;
            if($estudo->update($request->all())){
                alert()->success('Concluído','Registro atualizado com sucesso.');
            }else{
                alert()->error('ErrorAlert','Erro na atualização do registro.');
            }
        }
        
        return redirect()->route('estudo.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $estudo = Estudo::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$estudo){
            abort(404, 'Registro não encotrado!');
        }
        $estudo->delete();

        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('estudo.index');
    }
}
