@extends('adminlte::page')

@section('title', "Perfis do plano {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Planos</li>
    </ol>
    <h1>
        Perfis do plano {{ $plan->name }}
        <a href="{{ route('plans.profiles.available', $plan->url) }}" class="btn btn-dark">
            <i class="fas fa-plus-square"></i> Add novo perfil
        </a>
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('plans.profiles.search', $plan->url) }}"
                  method="GET"
                  class="form form-inline">
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
                                <a href="{{ route('plans.profiles.detach', [$plan->url, $profile->id]) }}" class="btn btn-danger">DESVINCULAR</a>
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
