@extends('adminlte::page')

@section('title', "Detalhes do cargo $role->name")

@section('content_header')
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

            <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar o cargo <b>{{ $role->name }}</b></button>
            </form>
        </div>
    </div>
@stop
