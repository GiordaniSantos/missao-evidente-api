@extends('layouts.app')

@section('titulo', 'Missão Evidente - Editar Ato Pastoral')

@section('content')
<div class="container-fluid">
    <a href="{{route('atos-pastorais.index')}}" class="btn btn-primary btn-icon-split m-0">
        <span class="icon text-white-50">
            <i class="fa-solid fa-list"></i>
        </span>
        <span class="text">Listar</span>
    </a>
    <div class="card mb-4" style="margin-top: 1.5rem">
        <div class="card-header">Editar Ato Pastoral: {{$ato->nome}}</div>
        <div class="card-body">
            @component('admin.atos-pastorais._form', ['ato' => $ato])
            @endcomponent
        </div>
    </div>
</div>
</div>
@endsection