<?php

namespace App\Http\Controllers;

use App\Models\Crente;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CrenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crentes = Crente::orderBy('id', 'desc')->where('id_usuario', \Auth::user()->id)->get();

        $title = 'Deletar visita ao crente!';
        $text = "Você tem certeza que quer deletar este registro?";
        confirmDelete($title, $text);
        return view('admin.crente.index', ['crentes' => $crentes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->input('_token') != '' && $request->input('id') == ''){
            //validacao
            $request->validate(Crente::rules(), Crente::feedback());
            $crente = new Crente();
            $crente->id_usuario = \Auth::user()->id;
            if($crente->save()){
                alert()->success('Concluído','Registro adicionado com sucesso.');
            }
        }
        return redirect()->route('crente.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Crente $crente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Crente $crente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Crente $crente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $crente = Crente::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$crente){
            abort(404, 'Registro não encotrado!');
        }
        $crente->delete();

        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('crente.index');
    }
}
