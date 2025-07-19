@extends('layouts.app')

@section('titulo', 'Missão em Ação - Visitas aos Crentes')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Visitas aos Crentes</h1>
        <p class="mb-4">Aqui estão listados todos os seus registros de Visitas aos Crentes, você pode adicionar, excluir e também realizar filtros de acordo com seu interesse.</p>
        <form method="post" action="{{ route('crente.store') }}" enctype="multipart/form-data">
            @csrf
            <button type="submit" class="btn btn-primary btn-icon-split m-0">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Criar</span>
            </button>
        </form><br>
        
        <div class="card shadow mb-4" style="margin-top: 1.5rem">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Visitas aos Crentes</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Data</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($crentes as $crente)
                                <tr>
                                    <td>Visita realizada no dia</td>
                                    <td>{{$crente->created_at->format('d/m/Y')}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa-solid fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{route('crente.edit', ['id' => $crente->id])}}">Atualizar</a>
                                                <a href="{{ route('crente.destroy', $crente->id) }}" class="dropdown-item" data-confirm-delete="true">Deletar</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection