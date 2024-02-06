@extends('adminlte::page')

@section('title', "Perfis do plano {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item active">Perfis</li>
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
                                <form method="POST" action="{{ route('plans.profiles.detach', [$plan->url, $profile->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">DESVINCULAR</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>Nenhum plano encontrado.</tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $pagination !!}
        </div>
    </div>
@stop
