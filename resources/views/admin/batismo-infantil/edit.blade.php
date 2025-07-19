@extends('layouts.app')

@section('titulo', 'Missão em Ação - Editar Batismo Infantil')

@section('content')
<div class="container-fluid">
    <a href="{{route('batismo-infantil.index')}}" class="btn btn-primary btn-icon-split m-0">
        <span class="icon text-white-50">
            <i class="fa-solid fa-list"></i>
        </span>
        <span class="text">Listar</span>
    </a>
    <div class="card mb-4" style="margin-top: 1.5rem">
        <div class="card-header">Editar data de batismo infantil: </div>
        <div class="card-body">
            @component('admin.batismo-infantil._form', ['batismoInfantil' => $batismoInfantil])
            @endcomponent
        </div>
    </div>
</div>
</div>
@endsection