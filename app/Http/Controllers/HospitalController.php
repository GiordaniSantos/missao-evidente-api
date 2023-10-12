<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospitais = Hospital::orderBy('created_at', 'desc')->where('id_usuario', \Auth::user()->id)->get();

        $title = 'Deletar visita ao hospital!';
        $text = "Você tem certeza que quer deletar este registro?";
        confirmDelete($title, $text);
        return view('admin.hospital.index', ['hospitais' => $hospitais]);
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
            $request->validate(Hospital::rules(), Hospital::feedback());
            $hospital = new Hospital();
            $hospital->id_usuario = \Auth::user()->id;
            if($hospital->save()){
                alert()->success('Concluído','Registro adicionado com sucesso.');
            }
        }
        return redirect()->route('hospital.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hospital $hospital)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hospital = Hospital::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$hospital){
            abort(404, 'Registro não encotrado!');
        }
        return view('admin.hospital.edit', ['hospital' => $hospital]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $hospital = Hospital::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$hospital){
            abort(404, 'Registro não encotrado!');
        }
        if($request->input('_token') != '' && $request->input('id') == ''){

            //validacao
            $request->validate(Hospital::rules(), Hospital::feedback());
            $hospital->id_usuario = \Auth::user()->id;
            if($hospital->update($request->all())){
                alert()->success('Concluído','Registro atualizado com sucesso.');
            }else{
                alert()->error('ErrorAlert','Erro na atualização do registro.');
            }
        }
        
        return redirect()->route('hospital.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hospital = Hospital::where('id', $id)->where('id_usuario', \Auth::user()->id)->first();
        if(!$hospital){
            abort(404, 'Registro não encotrado!');
        }
        $hospital->delete();

        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('hospital.index');
    }
}
