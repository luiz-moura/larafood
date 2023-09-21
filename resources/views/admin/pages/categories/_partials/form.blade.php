<x-alert-errors :errors="$errors"/>

@csrf

<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text"
           name="name"
           id="name"
           class="form-control"
           placeholder="Nome:"
           value="{{ $category->name ?? old('name') }}">
</div>
<div class="form-group">
    <label for="description">Descrição:</label>
    <textarea type="description"
           name="description"
           id="description"
           class="form-control"
           placeholder="Descrição:"
           rows="5"
           ols="30"
           >{{ $category->description ?? old('description') }}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">@isset($category) Editar @else Cadastrar @endisset</button>
</div>
