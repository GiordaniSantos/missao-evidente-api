<?php

namespace App\Http\Controllers;

use App\Models\Membresia;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MembresiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $membresias = Membresia::orderBy('id', 'desc')->where('id_usuario', \Auth::user()->id)->get();

        $title = 'Deletar dado de membresia!';
        $text = "Você tem certeza que quer deletar este registro?";
        confirmDelete($title, $text);
        return view('admin.membresia.index', ['membresias' => $membresias, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.membresia.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->input('_token') != '' && $request->input('id') == ''){
            //validacao
            $request->validate(Membresia::rules(), Membresia::feedback());
            $membresia = new Membresia();
            $membresia->nome = $request->input('nome');
            $membresia->quantidade = $request->input('quantidade');
            $membresia->id_usuario = \Auth::user()->id;
            if($membresia->save()){
                alert()->success('Concluído','Registro adicionado com sucesso.');
            }
        }
        return redirect()->route('membresia.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Membresia $membresia)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $membresia = Membresia::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$membresia){
            abort(404, 'Registro não encotrado!');
        }
        return view('admin.membresia.edit', ['membresia' => $membresia]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $membresia = Membresia::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$membresia){
            abort(404, 'Registro não encotrado!');
        }
        if($request->input('_token') != '' && $request->input('id') == ''){

            //validacao
            $request->validate(Membresia::rules(), Membresia::feedback());
            $membresia->id_usuario = \Auth::user()->id;
            if($membresia->update($request->all())){
                alert()->success('Concluído','Registro atualizado com sucesso.');
            }else{
                alert()->error('ErrorAlert','Erro na atualização do registro.');
            }
        }
        
        return redirect()->route('membresia.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $membresia = Membresia::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$membresia){
            abort(404, 'Registro não encotrado!');
        }
        $membresia->delete();

        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('membresia.index');
    }
}
