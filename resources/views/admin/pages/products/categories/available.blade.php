@extends('adminlte::page')

@section('title', "Categorias disponíveis - Produto {$product->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.categories', $product->id) }}">Categorias</a></li>
        <li class="breadcrumb-item active">Vincular</li>
    </ol>
    <h1>Categorias disponíveis - Produto {{ $product->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <x-alert-errors/>

            <table class="table-condensed table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('products.categories.attach', $product->id) }}" method="post">
                        @csrf
                        @forelse ($categories as $category)
                            <tr>
                                <td><input type="checkbox" name="categories[]" value="{{ $category->id }}"></td>
                                <td>{{ $category->name }}</td>
                            </tr>
                        @empty
                            <tr>Nenhuma categoria encontrada.</tr>
                        @endforelse
                        <tr>
                            <td colspan="500">
                                <button type="submit" class="btn btn-success">Vincular</button>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $pagination !!}
        </div>
    </div>
@stop
