<x-alert-errors :errors="$errors"/>

<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text"
           name="name"
           id="name"
           class="form-control"
           placeholder="Nome:"
           @isset($plan) value="{{ $plan->name }}" @endisset>
</div>
<div class="form-group">
    <label for="price">Preço:</label>
    <input type="text"
           name="price"
           id="price"
           class="form-control"
           placeholder="Preço:"
           @isset($plan) value="{{ $plan->price }}" @endisset>
</div>
<div class="form-group">
    <label for="description">Descrição:</label>
    <input type="text"
           name="description"
           id="description"
           class="form-control"
           placeholder="Descrição:"
           @isset($plan) value="{{ $plan->description }}" @endisset>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>
