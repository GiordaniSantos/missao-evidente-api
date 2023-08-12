@extends('layouts.app')

@section('titulo', 'Missão Evidente - Criar Membresia')

@section('content')
<div class="container-fluid">
    <a href="{{route('membresia.index')}}" class="btn btn-primary btn-icon-split m-0">
        <span class="icon text-white-50">
            <i class="fa-solid fa-list"></i>
        </span>
        <span class="text">Listar</span>
    </a>
    <div class="card mb-4" style="margin-top: 1.5rem">
        <div class="card-header">Criar Membresia</div>
        <div class="card-body">
            @component('admin.membresia._form')
            @endcomponent
        </div>
    </div>
</div>
</div>
@endsection