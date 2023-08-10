@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header">Criar Membresia</div>
        <div class="card-body">
            @component('admin.membresia._form')
            @endcomponent
        </div>
    </div>
</div>
@endsection