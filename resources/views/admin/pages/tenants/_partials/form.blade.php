<x-alert-errors :errors="$errors"/>

@csrf

<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text"
           name="name"
           id="name"
           class="form-control"
           placeholder="Nome"
           value="{{ $tenant->name ?? old('name') }}">
</div>
<div class="form-group">
    <label for="logo">Logo:</label>
    <div class="input-group mb-3">
        <div class="custom-file">
            <input type="file"
                   class="custom-file-input"
                   id="logo"
                   aria-describedby="upload">
            <label for="logo" class="custom-file-label">Choose file</label>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="email">E-mail:</label>
    <input type="email"
           name="email"
           id="email"
           class="form-control"
           placeholder="Nome"
           value="{{ $tenant->email ?? old('email') }}">
</div>
<div class="form-group">
    <label for="cnpj">CNPJ:</label>
    <input type="text"
           name="cnpj"
           id="cnpj"
           class="form-control"
           placeholder="Nome"
           value="{{ $tenant->cnpj ?? old('cnpj') }}">
</div>
<div class="form-group">
    <label for="active">Ativo?</label>
    <select name="active" id="active" class="form-control">
        <option value="Y" @if(isset($tenant) && $tenant->active == 'Y') selected @endif>SIM</option>
        <option value="N" @if(isset($tenant) && $tenant->active == 'N') selected @endif>Não</option>
    </select>
</div>

<h3>Assinatura</h3>

<div class="form-group">
    <label for="subscribed_at">Data assinatura (início):</label>
    <input type="date"
           name="subscribed_at"
           id="subscribed_at"
           class="form-control"
           value="{{ $tenant->subscribed_at->format('Y-m-d') ?? old('subscribed_at') }}">
</div>
<div class="form-group">
    <label for="expires_at">Expira (final):</label>
    <input type="date"
           name="expires_at"
           id="expires_at"
           class="form-control"
           value="{{ $tenant->expires_at?->format('Y-m-d') }}">
</div>
<div class="form-group">
    <label for="subscription_id">Identificador:</label>
    <input type="text"
           name="subscription_id"
           id="subscription_id"
           class="form-control"
           placeholder="Identificador"
           value="{{ $tenant->subscription_id ?? old('subscription_id') }}">
</div>
<div class="form-group">
    <label for="subscription_active">Assinatura Ativa?</label>
    <select name="subscription_active" id="subscription_active" class="form-control">
        <option value="1" @if(isset($tenant) && $tenant->subscription_active) selected @endif>SIM</option>
        <option value="0" @if(isset($tenant) && !$tenant->subscription_active) selected @endif>Não</option>
    </select>
</div>
<div class="form-group">
    <label for="subscription_suspended">Assinatura Cancelada?</label>
    <select name="subscription_suspended" id="subscription_suspended" class="form-control">
        <option value="1" @if(isset($tenant) && $tenant->subscription_suspended) selected @endif>SIM</option>
        <option value="0" @if(isset($tenant) && !$tenant->subscription_suspended) selected @endif>Não</option>
    </select>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-dark">@isset($tenant) Editar @else Cadastrar @endisset</button>
</div>
