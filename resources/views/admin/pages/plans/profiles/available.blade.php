@extends('adminlte::page')

@section('title', "Perfis disponíveis - Plan {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item active">Perfis</li>
    </ol>
    <h1>Perfis disponíveis - Plano: {{ $plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('plans.profiles.search-available', $plan->url) }}"
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
                <x-alert-errors/>

                <table class="table-condensed table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('plans.profiles.attach', $plan->url) }}" method="post">
                            @csrf
                            @forelse ($profiles as $profiles)
                                <tr>
                                    <td><input type="checkbox" name="profiles[]" value="{{ $profiles->id }}"></td>
                                    <td>{{ $profiles->name }}</td>
                                </tr>
                            @empty
                                <tr>Nenhum perfil encontrado.</tr>
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
