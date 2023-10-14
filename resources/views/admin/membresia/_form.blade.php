<?php 
$list = [
    'Primeiro Domingo',
    'Segundo Domingo',
    'Terceiro Domingo',
    'Quarto Domingo',
    'Quinto Domingo',
    'Comungantes',
    'Não Comungantes'
]
?>

@if(isset($membresium->id))
<form method="post" action="{{ route('membresia.update', ['id' => $membresium->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
@else
<form method="post" action="{{ route('membresia.store') }}" enctype="multipart/form-data">
    @csrf
@endif
    <!-- Form Row-->
    <div class="row gx-3 mb-3">
        <!-- Form Group (first name)-->
        <div class="col-md-4">
            <label class="small mb-1" for="nome">Nome</label>
            <select name="nome" class="form-control">
                <option> Escolha uma Opção </option>
                <option value="{{$list[0]}}" @if(isset($membresium)){{ ($membresium->nome ?? old('nome')) == $list[0] ? 'selected' : '' }}@endif> Primeiro Domingo </option>
                <option value="{{$list[1]}}" @if(isset($membresium)){{ ($membresium->nome ?? old('nome')) == $list[1] ? 'selected' : '' }}@endif> Segundo Domingo </option>
                <option value="{{$list[2]}}" @if(isset($membresium)){{ ($membresium->nome ?? old('nome')) == $list[2] ? 'selected' : '' }}@endif> Terceiro Domingo </option>
                <option value="{{$list[3]}}" @if(isset($membresium)){{ ($membresium->nome ?? old('nome')) == $list[3] ? 'selected' : '' }}@endif> Quarto Domingo </option>
                <option value="{{$list[4]}}" @if(isset($membresium)){{ ($membresium->nome ?? old('nome')) == $list[4] ? 'selected' : '' }}@endif> Quinto Domingo </option>
                <option value="{{$list[5]}}" @if(isset($membresium)){{ ($membresium->nome ?? old('nome')) == $list[5] ? 'selected' : '' }}@endif> Comungantes </option>
                <option value="{{$list[6]}}" @if(isset($membresium)){{ ($membresium->nome ?? old('nome')) == $list[6] ? 'selected' : '' }}@endif> Não Comungantes </option>
            </select>
            {{ $errors->has('nome') ? $errors->first('nome') : '' }}
        </div>
        <!-- Form Group (last name)-->
        <div class="col-md-4">
            <label class="small mb-1" for="quantidade">Quantidade</label>
            <input class="form-control" id="quantidade" name="quantidade" type="number" placeholder="" value="{{ $membresium->quantidade ?? old('quantidade') }}">
        </div>
        <div class="col-md-4">
            <label class="small mb-1" for="created_at">Data</label>
            <input class="form-control" id="created_at" name="created_at" type="datetime-local" placeholder="Data" value="{{ $membresium->created_at ?? old('data') }}">
        </div>
    </div>
    <!-- Save changes button-->
    <button class="btn btn-primary" type="submit">@if(isset($membresium))Atualizar @else Salvar @endif</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>
<script>
    
    config = {
        enableTime: true,
        dateFormat: 'Y/m/d H:i',
        locale: 'pt',
        format: "d/m/Y H:i",
        altFormat: "d/m/Y H:i",
        altInput: true
    }
    flatpickr("input[type=datetime-local]", config);
</script>