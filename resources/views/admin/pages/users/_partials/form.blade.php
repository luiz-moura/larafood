<x-alert-errors :errors="$errors"/>

@csrf

<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text"
           name="name"
           id="name"
           class="form-control"
           placeholder="Nome:"
           @isset($user) value="{{ $user->name }}" @endisset>
</div>
<div class="form-group">
    <label for="email">E-mail:</label>
    <input type="email"
           name="email"
           id="email"
           class="form-control"
           placeholder="E-mail:"
           @isset($user) value="{{ $user->email }}" @endisset>
</div>
<div class="form-group">
    <label for="password">Senha:</label>
    <input type="password"
           name="password"
           id="password"
           class="form-control"
           placeholder="Senha:">
</div>
<div class="form-group">
    <label for="password_confirmation">Confirmar senha:</label>
    <input type="password"
           name="password_confirmation"
           id="password_confirmation"
           class="form-control"
           placeholder="Senha:">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">@isset($user) Editar @else Cadastrar @endisset</button>
</div>
