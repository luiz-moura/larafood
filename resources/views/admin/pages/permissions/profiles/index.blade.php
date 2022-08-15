@extends('adminlte::page')

@section('title', "Perfis da permissão {$permission->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Permissões</a></li>
        <li class="breadcrumb-item active">Perfis da permissão</li>
    </ol>
    <h1>Perfis da permissão {{ $permission->name }}</h1>
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
                    @forelse ($profiles as $profile)
                        <tr>
                            <td>{{ $profile->name }}</td>
                            <td>
                                <a href="{{ route('profiles.permissions.detach', [$profile->id, $permission->id]) }}" class="btn btn-danger">DESVINCULAR</a>
                            </td>
                        </tr>
                    @empty
                        <p>No profiles</p>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $pagination !!}
        </div>
    </div>
@stop
