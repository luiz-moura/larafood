<x-alert-errors/>

@csrf

<div class="form-group">
    <label for="name">Nome</label>
    <input type="text"
           name="name"
           placeholder="Nome"
           id="name"
           class="form-control"
           value="{{ $planDetail->name ?? old('name') }}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-info">@isset($planDetail) Editar @else Cadastrar @endisset</button>
</div>
