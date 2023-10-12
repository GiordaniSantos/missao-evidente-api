@extends('layouts.app')

@section('titulo', 'Missão Evidente - Editar visita ao não Crente')

@section('content')
<div class="container-fluid">
    <a href="{{route('nao-crente.index')}}" class="btn btn-primary btn-icon-split m-0">
        <span class="icon text-white-50">
            <i class="fa-solid fa-list"></i>
        </span>
        <span class="text">Listar</span>
    </a>
    <div class="card mb-4" style="margin-top: 1.5rem">
        <div class="card-header">Editar data de visita ao não crente: </div>
        <div class="card-body">
            @component('admin.incredulo._form', ['incredulo' => $incredulo])
            @endcomponent
        </div>
    </div>
</div>
</div>
@endsection