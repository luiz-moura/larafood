@extends('adminlte::page')

@section('title', "Permissões do cargo {$role->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Cargos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.show', $role->id) }}">{{ $role->name }}</a></li>
        <li class="breadcrumb-item active">Permissões</li>
    </ol>
    <h1>
        Permissões do cargo {{ $role->name }}
        <a href="{{ route('roles.permissions.available', $role->id) }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> Add nova permissão</a>
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
                    @forelse ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <a href="{{ route('roles.permissions.detach', [$role->id, $permission->id]) }}" class="btn btn-danger">DESVINCULAR</a>
                            </td>
                        </tr>
                    @empty
                        <tr>Nenhuma permissão encontrada.</tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $pagination !!}
        </div>
    </div>
@stop
