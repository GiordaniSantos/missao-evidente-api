<?php

namespace App\Http\Controllers;

use App\Models\Presidio;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PresidioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presidios = Presidio::orderBy('id', 'desc')->where('id_usuario', \Auth::user()->id)->get();

        $title = 'Deletar visita ao presidio!';
        $text = "Você tem certeza que quer deletar este registro?";
        confirmDelete($title, $text);
        return view('admin.presidio.index', ['presidios' => $presidios]);
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
            $request->validate(Presidio::rules(), Presidio::feedback());
            $presidio = new Presidio();
            $presidio->id_usuario = \Auth::user()->id;
            if($presidio->save()){
                alert()->success('Concluído','Registro adicionado com sucesso.');
            }
        }
        return redirect()->route('presidio.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Presidio $presidio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presidio $presidio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presidio $presidio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $presidio = Presidio::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$presidio){
            abort(404, 'Registro não encotrado!');
        }
        $presidio->delete();

        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('presidio.index');
    }
}
