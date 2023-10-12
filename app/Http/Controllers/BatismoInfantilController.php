<?php

namespace App\Http\Controllers;

use App\Models\BatismoInfantil;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BatismoInfantilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batismosInfantis = BatismoInfantil::orderBy('created_at', 'desc')->where('id_usuario', \Auth::user()->id)->get();

        $title = 'Deletar registro de Batismo Infantil!';
        $text = "Você tem certeza que quer deletar este registro?";
        confirmDelete($title, $text);
        return view('admin.batismo-infantil.index', ['batismosInfantis' => $batismosInfantis]);
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
            $request->validate(BatismoInfantil::rules(), BatismoInfantil::feedback());
            $batismoInfantil = new BatismoInfantil();
            $batismoInfantil->id_usuario = \Auth::user()->id;
            if($batismoInfantil->save()){
                alert()->success('Concluído','Registro adicionado com sucesso.');
            }
        }
        return redirect()->route('batismo-infantil.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(BatismoInfantil $batismoInfantil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $batismoInfantil = BatismoInfantil::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$batismoInfantil){
            abort(404, 'Registro não encotrado!');
        }
        return view('admin.batismo-infantil.edit', ['batismoInfantil' => $batismoInfantil]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $batismoInfantil = BatismoInfantil::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$batismoInfantil){
            abort(404, 'Registro não encotrado!');
        }
        if($request->input('_token') != '' && $request->input('id') == ''){

            //validacao
            $request->validate(BatismoInfantil::rules(), BatismoInfantil::feedback());
            $batismoInfantil->id_usuario = \Auth::user()->id;
            if($batismoInfantil->update($request->all())){
                alert()->success('Concluído','Registro atualizado com sucesso.');
            }else{
                alert()->error('ErrorAlert','Erro na atualização do registro.');
            }
        }
        
        return redirect()->route('batismo-infantil.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $batismoInfantil = BatismoInfantil::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$batismoInfantil){
            abort(404, 'Registro não encotrado!');
        }
        $batismoInfantil->delete();

        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('batismo-infantil.index');
    }
}
