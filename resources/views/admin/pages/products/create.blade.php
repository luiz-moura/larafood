@extends('adminlte::page')

@section('title', 'Cadastrar novo produto')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="breadcrumb-item active">Criar</li>
    </ol>
    <h1>Cadastrar novo produto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.store') }}"
                  method="post"
                  enctype="multipart/form-data"
                  class="form">
                @include('admin.pages.products._partials.form')
            </form>
        </div>
    </div>
@stop
