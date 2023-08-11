<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membresia;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $mes = date('m');
        $ano = date('Y');

        $queryMembresias = Membresia::query();
        $queryMembresias->where('id_usuario', \Auth::user()->id);
        $queryMembresias->orderBy('created_at', 'asc');
        if ($request->has('ano')) {
            $queryMembresias->whereYear('created_at', '=', $request->ano);
        }else{
            $queryMembresias->whereYear('created_at', '=', $ano);
        }

        if ($request->has('mes')) {
            $queryMembresias->whereMonth('created_at', '=', $request->mes);
        }else{
            $queryMembresias->whereMonth('created_at', '=', $mes);
        }

        $membresias = $queryMembresias->get();

        return view('home', ['membresias' => $membresias]);
    }
}
