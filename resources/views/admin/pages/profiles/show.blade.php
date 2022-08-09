@extends('adminlte::page')

@section('title', "Detalhes do perfil $profile->name")

@section('content_header')
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

            <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar o perfil <b>{{ $profile->name }}</b></button>
            </form>
        </div>
    </div>
@stop
