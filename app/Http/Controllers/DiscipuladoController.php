<?php

namespace App\Http\Controllers;

use App\Models\Discipulado;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DiscipuladoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discipulados = Discipulado::orderBy('created_at', 'desc')->where('id_usuario', \Auth::user()->id)->get();

        $title = 'Deletar registro de Discipulado!';
        $text = "Você tem certeza que quer deletar este registro?";
        confirmDelete($title, $text);
        return view('admin.discipulado.index', ['discipulados' => $discipulados]);
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
            $request->validate(Discipulado::rules(), Discipulado::feedback());
            $discipulado = new Discipulado();
            $discipulado->id_usuario = \Auth::user()->id;
            if($discipulado->save()){
                alert()->success('Concluído','Registro adicionado com sucesso.');
            }
        }
        return redirect()->route('discipulado.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discipulado $discipulado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $discipulado = Discipulado::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$discipulado){
            abort(404, 'Registro não encotrado!');
        }
        return view('admin.discipulado.edit', ['discipulado' => $discipulado]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $discipulado = Discipulado::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$discipulado){
            abort(404, 'Registro não encotrado!');
        }
        if($request->input('_token') != '' && $request->input('id') == ''){

            //validacao
            $request->validate(Discipulado::rules(), Discipulado::feedback());
            $discipulado->id_usuario = \Auth::user()->id;
            if($discipulado->update($request->all())){
                alert()->success('Concluído','Registro atualizado com sucesso.');
            }else{
                alert()->error('ErrorAlert','Erro na atualização do registro.');
            }
        }
        
        return redirect()->route('discipulado.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $discipulado = Discipulado::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$discipulado){
            abort(404, 'Registro não encotrado!');
        }
        $discipulado->delete();

        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('discipulado.index');
    }
}
