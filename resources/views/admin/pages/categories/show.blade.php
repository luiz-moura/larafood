@extends('adminlte::page')

@section('title', "Detalhes da categoria $category->name")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorias</a></li>
        <li class="breadcrumb-item active">{{ $category->name }}</li>
    </ol>
    <h1>Detalhes da categoria <b>{{ $category->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: </strong> {{ $category->name }}</li>
                <li><strong>Descrição: </strong> {{ $category->description }}</li>
                <li><strong>URL: </strong> {{ $category->url }}</li>
            </ul>

            <x-alert-errors/>

            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Deletar a categoria <b>{{ $category->name }}</b>
                </button>
            </form>
        </div>
    </div>
@stop
