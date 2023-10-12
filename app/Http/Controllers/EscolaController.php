<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EscolaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $escolas = Escola::orderBy('created_at', 'desc')->where('id_usuario', \Auth::user()->id)->get();

        $title = 'Deletar visita à escola!';
        $text = "Você tem certeza que quer deletar este registro?";
        confirmDelete($title, $text);
        return view('admin.escola.index', ['escolas' => $escolas]);
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
            $request->validate(Escola::rules(), Escola::feedback());
            $escola = new Escola();
            $escola->id_usuario = \Auth::user()->id;
            if($escola->save()){
                alert()->success('Concluído','Registro adicionado com sucesso.');
            }
        }
        return redirect()->route('escola.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Escola $escola)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $escola = Escola::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$escola){
            abort(404, 'Registro não encotrado!');
        }
        return view('admin.escola.edit', ['escola' => $escola]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $escola = Escola::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$escola){
            abort(404, 'Registro não encotrado!');
        }
        if($request->input('_token') != '' && $request->input('id') == ''){

            //validacao
            $request->validate(Escola::rules(), Escola::feedback());
            $escola->id_usuario = \Auth::user()->id;
            if($escola->update($request->all())){
                alert()->success('Concluído','Registro atualizado com sucesso.');
            }else{
                alert()->error('ErrorAlert','Erro na atualização do registro.');
            }
        }
        
        return redirect()->route('escola.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $escola = Escola::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$escola){
            abort(404, 'Registro não encotrado!');
        }
        $escola->delete();

        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('escola.index');
    }
}
