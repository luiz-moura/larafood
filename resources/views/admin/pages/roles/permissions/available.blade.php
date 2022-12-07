@extends('adminlte::page')

@section('title', "Permissões disponíveis - cargo {$role->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Cargos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.show', $role->url) }}">{{ $role->name }}</a></li>
        <li class="breadcrumb-item active">Permissões</li>
    </ol>
    <h1>Permissões disponíveis - cargo {{ $role->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('roles.permissions.search', $role->id) }}" method="GET" class="form form-inline">
                <input type="text"
                       name="filter"
                       placeholder="Nome"
                       class="form-control"
                       value="{{ request()->filter }}"
                       minlength="2">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
                <x-alert-errors/>

                <table class="table-condensed table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('roles.permissions.attach', $role->id) }}" method="post">
                            @csrf
                            @forelse ($permissions as $permission)
                                <tr>
                                    <td><input type="checkbox" name="permissions[]" value="{{ $permission->id }}"></td>
                                    <td>{{ $permission->name }}</td>
                                </tr>
                            @empty
                                <tr>Nenhuma permissão encontrada.</tr>
                            @endforelse
                            <tr>
                                <td colspan="500">
                                    <button type="submit" class="btn btn-success">Vincular</button>
                                </td>
                            </tr>
                        </form>
                    </tbody>
                </table>
        </div>
        <div class="card-footer">
            {!! $pagination !!}
        </div>
    </div>
@stop
