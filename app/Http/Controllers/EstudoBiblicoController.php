<?php

namespace App\Http\Controllers;

use App\Models\EstudoBiblico;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EstudoBiblicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudosBiblicos = EstudoBiblico::orderBy('created_at', 'desc')->where('id_usuario', \Auth::user()->id)->get();

        $title = 'Deletar registro de Estudo Biblico!';
        $text = "Você tem certeza que quer deletar este registro?";
        confirmDelete($title, $text);
        return view('admin.estudo-biblico.index', ['estudosBiblicos' => $estudosBiblicos]);
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
            $request->validate(EstudoBiblico::rules(), EstudoBiblico::feedback());
            $estudoBiblico = new EstudoBiblico();
            $estudoBiblico->id_usuario = \Auth::user()->id;
            if($estudoBiblico->save()){
                alert()->success('Concluído','Registro adicionado com sucesso.');
            }
        }
        return redirect()->route('estudo-biblico.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(EstudoBiblico $estudoBiblico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $estudoBiblico = EstudoBiblico::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$estudoBiblico){
            abort(404, 'Registro não encotrado!');
        }
        return view('admin.estudo-biblico.edit', ['estudoBiblico' => $estudoBiblico]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $estudoBiblico = EstudoBiblico::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$estudoBiblico){
            abort(404, 'Registro não encotrado!');
        }
        if($request->input('_token') != '' && $request->input('id') == ''){

            //validacao
            $request->validate(EstudoBiblico::rules(), EstudoBiblico::feedback());
            $estudoBiblico->id_usuario = \Auth::user()->id;
            if($estudoBiblico->update($request->all())){
                alert()->success('Concluído','Registro atualizado com sucesso.');
            }else{
                alert()->error('ErrorAlert','Erro na atualização do registro.');
            }
        }
        
        return redirect()->route('estudo-biblico.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $estudoBiblico = EstudoBiblico::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$estudoBiblico){
            abort(404, 'Registro não encotrado!');
        }
        $estudoBiblico->delete();

        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('estudo-biblico.index');
    }
}
