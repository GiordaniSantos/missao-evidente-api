@extends('layouts.app')

@section('titulo', 'Missão em Ação - Editar Discipulado')

@section('content')
<div class="container-fluid">
    <a href="{{route('discipulado.index')}}" class="btn btn-primary btn-icon-split m-0">
        <span class="icon text-white-50">
            <i class="fa-solid fa-list"></i>
        </span>
        <span class="text">Listar</span>
    </a>
    <div class="card mb-4" style="margin-top: 1.5rem">
        <div class="card-header">Editar data de Discipulado: </div>
        <div class="card-body">
            @component('admin.discipulado._form', ['discipulado' => $discipulado])
            @endcomponent
        </div>
    </div>
</div>
</div>
@endsection