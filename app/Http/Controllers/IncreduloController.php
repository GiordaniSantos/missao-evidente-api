<?php

namespace App\Http\Controllers;

use App\Models\Incredulo;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class IncreduloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incredulos = Incredulo::orderBy('id', 'desc')->where('id_usuario', \Auth::user()->id)->get();

        $title = 'Deletar visita ao não crente!';
        $text = "Você tem certeza que quer deletar este registro?";
        confirmDelete($title, $text);
        return view('admin.incredulo.index', ['incredulos' => $incredulos]);
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
            $request->validate(Incredulo::rules(), Incredulo::feedback());
            $incredulo = new Incredulo();
            $incredulo->id_usuario = \Auth::user()->id;
            if($incredulo->save()){
                alert()->success('Concluído','Registro adicionado com sucesso.');
            }
        }
        return redirect()->route('nao-crente.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Incredulo $incredulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Incredulo $incredulo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Incredulo $incredulo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $incredulo = Incredulo::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$incredulo){
            abort(404, 'Registro não encotrado!');
        }
        $incredulo->delete();

        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('nao-crente.index');
    }
}
