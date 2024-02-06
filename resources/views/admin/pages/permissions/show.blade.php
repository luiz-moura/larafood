@extends('adminlte::page')

@section('title', "Detalhes da permissão $permission->name")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permissões</a></li>
        <li class="breadcrumb-item active">{{ $permission->name }}</li>
    </ol>
    <h1>Detalhes da permissão <b>{{ $permission->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: </strong> {{ $permission->name }}</li>
                <li><strong>Descrição: </strong> {{ $permission->description }}</li>
            </ul>

            <x-alert-errors/>
        </div>
        <div class="card-footer">
            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info mr-2">Editar</a>
            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Deletar a permissão <b>{{ $permission->name }}</b>
                </button>
            </form>
        </div>
    </div>
@stop
