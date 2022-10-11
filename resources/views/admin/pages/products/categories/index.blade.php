@extends('adminlte::page')

@section('title', "Categorias do produto {$product->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></li>
        <li class="breadcrumb-item active">Categorias</li>
    </ol>
    <h1>Categorias do produto {{ $product->name }} <a href="{{ route('products.categories.available', $product->id) }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> Add nova categoria</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('products.categories.search', $product->id) }}"
                  method="GET"
                  class="form form-inline">
                <input type="text"
                       name="filter"
                       placeholder="Nome"
                       class="form-control"
                       value="{{ request()->filter }}"
                       minlength="2">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table-condensed table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>
                                <form method="POST" action="{{ route('products.categories.detach', [$product->id, $category->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">DESVINCULAR</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <p>No categories</p>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $pagination !!}
        </div>
    </div>
@stop
