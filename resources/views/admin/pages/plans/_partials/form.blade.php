<x-alert-errors :errors="$errors"/>

@csrf

<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text"
           name="name"
           id="name"
           class="form-control"
           placeholder="Nome:"
           value="{{ $plan->name ?? old('name') }}">
</div>
<div class="form-group">
    <label for="price">Preço:</label>
    <input type="text"
           name="price"
           id="price"
           class="form-control"
           placeholder="Preço:"
           value="{{ $plan->price ?? old('price') }}">
</div>
<div class="form-group">
    <label for="description">Descrição:</label>
    <input type="text"
           name="description"
           id="description"
           class="form-control"
           placeholder="Descrição:"
           value="{{ $plan->description ?? old('description') }}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">@isset($plan) Editar @else Cadastrar @endisset</button>
</div>
