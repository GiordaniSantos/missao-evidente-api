<?php 
$list = [
    'Estudo',
    'Sermões',
    'Estudo Bíblico',
    'Discipulados'
]
?>

@if(isset($pregacao->id))
<form method="post" action="{{ route('pregacao.update', ['pregacao' => $pregacao->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
@else
<form method="post" action="{{ route('pregacao.store') }}" enctype="multipart/form-data">
    @csrf
@endif
    <!-- Form Row-->
    <div class="row gx-3 mb-3">
        <!-- Form Group (first name)-->
        <div class="col-md-6">
            <label class="small mb-1" for="nome">Nome</label>
            <select name="nome" class="form-control">
                <option> Escolha uma Opção </option>
                <option value="{{$list[0]}}" @if(isset($pregacao)){{ ($pregacao->nome ?? old('nome')) == $list[0] ? 'selected' : '' }}@endif>Estudo</option>
                <option value="{{$list[1]}}" @if(isset($pregacao)){{ ($pregacao->nome ?? old('nome')) == $list[1] ? 'selected' : '' }}@endif> Sermões </option>
                <option value="{{$list[2]}}" @if(isset($pregacao)){{ ($pregacao->nome ?? old('nome')) == $list[2] ? 'selected' : '' }}@endif> Estudo Bíblico </option>
                <option value="{{$list[3]}}" @if(isset($pregacao)){{ ($pregacao->nome ?? old('nome')) == $list[3] ? 'selected' : '' }}@endif> Discipulados </option>
            </select>
            {{ $errors->has('nome') ? $errors->first('nome') : '' }}
        </div>
        <!-- Form Group (last name)-->
        <div class="col-md-6">
            <label class="small mb-1" for="quantidade">Quantidade</label>
            <input class="form-control" id="quantidade" name="quantidade" type="number" placeholder="" value="{{ $pregacao->quantidade ?? old('quantidade') }}">
        </div>
    </div>
    <!-- Save changes button-->
    <button class="btn btn-primary" type="submit">@if(isset($pregacao))Atualizar @else Salvar @endif</button>
</form>