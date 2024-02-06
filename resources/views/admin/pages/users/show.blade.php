@extends('adminlte::page')

@section('title', "Detalhes do usuário $user->name")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
        <li class="breadcrumb-item active">{{ $user->name }}</li>
    </ol>
    <h1>Detalhes do usuário <b>{{ $user->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: </strong> {{ $user->name }}</li>
                <li><strong>E-mail: </strong> {{ $user->email }}</li>
                <li><strong>Empresa: </strong> {{ $user->tenant?->name }}</li>
            </ul>

            <x-alert-errors/>
        </div>
        <div class="card-footer">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info mr-2">Editar</a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Deletar o usuário <b>{{ $user->name }}</b>
                </button>
            </form>
        </div>
    </div>
@stop
