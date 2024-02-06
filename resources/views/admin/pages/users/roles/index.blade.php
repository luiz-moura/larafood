@extends('adminlte::page')

@section('title', "Cargos do usuário {$user->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></li>
        <li class="breadcrumb-item active">Cargos</li>
    </ol>
    <h1>
        Cargos do usuário {{ $user->name }}
        <a href="{{ route('users.roles.available', $user->id) }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> Add novo cargo</a>
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table-condensed table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a href="{{ route('users.roles.detach', [$user->id, $role->id]) }}" class="btn btn-danger">DESVINCULAR</a>
                            </td>
                        </tr>
                    @empty
                        <tr>Nenhum cargo encontrado.</tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $pagination !!}
        </div>
    </div>
@stop
