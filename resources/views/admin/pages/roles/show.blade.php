@extends('adminlte::page')

@section('title', "Detalhes do cargo $role->name")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Cargos</a></li>
        <li class="breadcrumb-item active">{{ $role->name }}</li>
    </ol>
    <h1>Detalhes do cargo <b>{{ $role->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: </strong> {{ $role->name }}</li>
                <li><strong>Descrição: </strong> {{ $role->description }}</li>
            </ul>

            <x-alert-errors/>
        </div>
        <div class="card-footer">
            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info mr-2">Editar</a>
            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Deletar o cargo <b>{{ $role->name }}</b>
                </button>
            </form>
        </div>
    </div>
@stop
