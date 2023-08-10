@if(isset($membresium->id))
<form method="post" action="{{ route('membresia.update', ['membresium' => $membresium->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
@else
<form method="post" action="{{ route('membresia.store') }}" enctype="multipart/form-data">
    @csrf
@endif
    <!-- Form Row-->
    <div class="row gx-3 mb-3">
        <!-- Form Group (first name)-->
        <div class="col-md-6">
            <label class="small mb-1" for="nome">Nome</label>
            <select name="nome" class="form-control">
                <option> Escolha uma Opção </option>
                <option value="Primeiro Domingo" @if(isset($membresium)){{ ($membresium->nome ?? old('nome')) == $membresium->nome ? 'selected' : '' }}@endif> Primeiro Domingo </option>
                <option value="Segundo Domingo" @if(isset($membresium)){{ ($membresium->nome ?? old('nome')) == $membresium->nome ? 'selected' : '' }}@endif> Segundo Domingo </option>
                <option value="Terceiro Domingo" @if(isset($membresium)){{ ($membresium->nome ?? old('nome')) == $membresium->nome ? 'selected' : '' }}@endif> Terceiro Domingo </option>
                <option value="Quarto Domingo" @if(isset($membresium)){{ ($membresium->nome ?? old('nome')) == $membresium->nome ? 'selected' : '' }}@endif> Quarto Domingo </option>
                <option value="Quinto Domingo" @if(isset($membresium)){{ ($membresium->nome ?? old('nome')) == $membresium->nome ? 'selected' : '' }}@endif> Quinto Domingo </option>
                <option value="Comungantes" @if(isset($membresium)){{ ($membresium->nome ?? old('nome')) == $membresium->nome ? 'selected' : '' }}@endif> Comungantes </option>
                <option value="Não Comungantes" @if(isset($membresium)){{ ($membresium->nome ?? old('nome')) == $membresium->nome ? 'selected' : '' }}@endif> Não Comungantes </option>
            </select>
            {{ $errors->has('nome') ? $errors->first('nome') : '' }}
        </div>
        <!-- Form Group (last name)-->
        <div class="col-md-6">
            <label class="small mb-1" for="quantidade">Quantidade</label>
            <input class="form-control" id="quantidade" name="quantidade" type="number" placeholder="" value="{{ $membresium->quantidade ?? old('quantidade') }}">
        </div>
    </div>
    <!-- Save changes button-->
    <button class="btn btn-primary" type="submit">@if(isset($membresium))Atualizar @else Salvar @endif</button>
</form>