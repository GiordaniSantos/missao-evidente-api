<?php

namespace App\Http\Controllers;

use App\Models\Enfermo;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EnfermoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enfermos = Enfermo::orderBy('created_at', 'desc')->where('id_usuario', \Auth::user()->id)->get();

        $title = 'Deletar visita ao enfermo!';
        $text = "Você tem certeza que quer deletar este registro?";
        confirmDelete($title, $text);
        return view('admin.enfermo.index', ['enfermos' => $enfermos]);
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
            $request->validate(Enfermo::rules(), Enfermo::feedback());
            $enfermo = new Enfermo();
            $enfermo->id_usuario = \Auth::user()->id;
            if($enfermo->save()){
                alert()->success('Concluído','Registro adicionado com sucesso.');
            }
        }
        return redirect()->route('enfermo.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Enfermo $enfermo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $enfermo = Enfermo::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$enfermo){
            abort(404, 'Registro não encotrado!');
        }
        return view('admin.enfermo.edit', ['enfermo' => $enfermo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $enfermo = Enfermo::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$enfermo){
            abort(404, 'Registro não encotrado!');
        }
        if($request->input('_token') != '' && $request->input('id') == ''){

            //validacao
            $request->validate(Enfermo::rules(), Enfermo::feedback());
            $enfermo->id_usuario = \Auth::user()->id;
            if($enfermo->update($request->all())){
                alert()->success('Concluído','Registro atualizado com sucesso.');
            }else{
                alert()->error('ErrorAlert','Erro na atualização do registro.');
            }
        }
        
        return redirect()->route('enfermo.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $enfermo = Enfermo::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$enfermo){
            abort(404, 'Registro não encotrado!');
        }
        $enfermo->delete();

        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('enfermo.index');
    }
}
