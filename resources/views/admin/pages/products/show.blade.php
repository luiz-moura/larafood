@extends('adminlte::page')

@section('title', "Detalhes do produto $product->name")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="breadcrumb-item">{{ $product->name }}</li>
    </ol>
    <h1>Detalhes do produto <b>{{ $product->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: </strong> {{ $product->name }}</li>
                <li><strong>Descrição: </strong> {{ $product->description }}</li>
                <li><strong>Preço: </strong> {{ $product->price }}</li>
                <li><strong>Flag: </strong> {{ $product->flag }}</li>
                <li>
                    <strong>Imagem: </strong>
                    <img src="{{ url("storage/{$product->image}") }}"
                         alt="{{ $product->name }}"
                         style="max-width: 90px">
                </li>
            </ul>

            <x-alert-errors/>

            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Deletar o produto <b>{{ $product->name }}</b>
                </button>
            </form>
        </div>
    </div>
@stop
