@extends('adminlte::page')

@section('title', "Cargos disponíveis - perfil {$user->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></li>
        <li class="breadcrumb-item active">Cargos</li>
    </ol>
    <h1>Cargos disponíveis - perfil {{ $user->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('users.roles.search', $user->id) }}" method="GET" class="form form-inline">
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
                        <form action="{{ route('users.roles.attach', $user->id) }}" method="post">
                            @csrf
                            @forelse ($roles as $role)
                                <tr>
                                    <td><input type="checkbox" name="roles[]" value="{{ $role->id }}"></td>
                                    <td>{{ $role->name }}</td>
                                </tr>
                            @empty
                                <tr>Nenhum cargo encontrado.</tr>
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
