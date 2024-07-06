<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
  
    public function view()
    {
        $user = User::where('id', \Auth::user()->id)->first();

        return view('admin.user.view', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', \Auth::user()->id)->first();
        if(!$user){
            abort(404, 'Usuário não encotrado!');
        }
        if($request->input('_token') != '' && $request->input('id') == ''){
           
            //validacao
            $request->validate(User::rules(), User::feedback());
            if(isset($request->password)){
                $user->password = Hash::make($request->password);
            }
            if(isset($request->email) && $request->email != $user->email){
                $user->email = $request->email;
            }
            $user->name = $request->name;
            if($user->save()){
                alert()->success('Concluído','Perfil atualizado com sucesso.');
            }else{
                alert()->error('ErrorAlert','Erro na atualização do Perfil.');
            }
        }
        
        return redirect()->route('user.view');
    }
}
