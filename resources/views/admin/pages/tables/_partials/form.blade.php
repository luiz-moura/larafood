<x-alert-errors :errors="$errors"/>

@csrf

<div class="form-group">
    <label for="identify">Identificação:</label>
    <input type="text"
           name="identify"
           id="identify"
           class="form-control"
           placeholder="Nome:"
           value="{{ $table->identify ?? old('identify') }}">
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
           >{{ $table->description ?? old('description') }}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">@isset($table) Editar @else Cadastrar @endisset</button>
</div>
