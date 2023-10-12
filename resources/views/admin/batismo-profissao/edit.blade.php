@extends('layouts.app')

@section('titulo', 'Missão Evidente - Editar Batismo e Profissão de Fé')

@section('content')
<div class="container-fluid">
    <a href="{{route('batismo-profissao.index')}}" class="btn btn-primary btn-icon-split m-0">
        <span class="icon text-white-50">
            <i class="fa-solid fa-list"></i>
        </span>
        <span class="text">Listar</span>
    </a>
    <div class="card mb-4" style="margin-top: 1.5rem">
        <div class="card-header">Editar data de Batismo e Profissão de Fé: </div>
        <div class="card-body">
            @component('admin.batismo-profissao._form', ['batismoProfissao' => $batismoProfissao])
            @endcomponent
        </div>
    </div>
</div>
</div>
@endsection