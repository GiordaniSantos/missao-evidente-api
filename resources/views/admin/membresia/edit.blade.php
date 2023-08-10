@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header">Editar Membresia: {{$membresia->nome}}</div>
        <div class="card-body">
            @component('admin.membresia._form', ['membresium' => $membresia])
            @endcomponent
        </div>
    </div>
</div>
@endsection