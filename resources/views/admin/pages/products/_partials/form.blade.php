<x-alert-errors :errors="$errors"/>

@csrf

<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text"
           name="name"
           id="name"
           class="form-control"
           placeholder="Nome"
           value="{{ $product->name ?? old('name') }}">
</div>
<div class="form-group">
    <label for="description">Descrição:</label>
    <textarea type="description"
           name="description"
           id="description"
           class="form-control"
           placeholder="Descrição"
           rows="5"
           ols="30"
           >{{ $product->description ?? old('description') }}</textarea>
</div>
<div class="form-group">
    <label for="price">Preço:</label>
    <input type="text"
           name="price"
           id="price"
           class="form-control"
           placeholder="Preço"
           value="{{ $product->price ?? old('price') }}">
</div>
<div class="form-group">
    <label for="file">Imagem:</label>
    <input type="file"
           name="file"
           id="file">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>
