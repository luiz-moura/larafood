@extends('adminlte::page')

@section('title', "Detalhes da mesa $table->identify")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tables.index') }}">Mesas</a></li>
        <li class="breadcrumb-item">{{ $table->identify }}</li>
    </ol>
    <h1>Detalhes da mesa <b>{{ $table->identify }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Identificação: </strong> {{ $table->identify }}</li>
                <li><strong>Descrição: </strong> {{ $table->description }}</li>
            </ul>

            <x-alert-errors/>
        </div>
        <div class="card-footer">
            <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-info mr-2">Editar</a>
            <form action="{{ route('tables.destroy', $table->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Deletar a mesa <b>{{ $table->identify }}</b>
                </button>
            </form>
        </div>
    </div>
@stop
