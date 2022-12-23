@extends('adminlte::page')

@section('title', "Editar o produto {$product->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
    <h1>Editar o produto {{ $product->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}"
                  method="post"
                  class="form"
                  enctype="multipart/form-data">
                @method('PUT')
                @include('admin.pages.products._partials.form')
            </form>
        </div>
    </div>
@stop
