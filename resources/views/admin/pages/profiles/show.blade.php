@extends('adminlte::page')

@section('title', "Detalhes do perfil $profile->name")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Perfis</a></li>
        <li class="breadcrumb-item">{{ $profile->name }}</li>
    </ol>
    <h1>Detalhes do perfil <b>{{ $profile->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: </strong> {{ $profile->name }}</li>
                <li><strong>Descrição: </strong> {{ $profile->description }}</li>
            </ul>

            <x-alert-errors/>
        </div>
        <div class="card-footer">
            <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-info mr-2">Editar</a>
            <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Deletar o perfil <b>{{ $profile->name }}</b>
                </button>
            </form>
        </div>
    </div>
@stop
