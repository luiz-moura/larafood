@extends('adminlte::page')

@section('title', "Detalhes do plano {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item active">Detalhes</li>
    </ol>
    <h1>
        Detalhes do plano {{ $plan->name }}
        <a href="{{ route('plan_details.create', $plan->url) }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> Add</a>
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
                    @forelse ($details as $detail)
                        <tr>
                            <td>{{ $detail->name }}</td>
                            <td>
                                <a href="{{ route('plan_details.edit', [$plan->url, $detail->id]) }}" class="btn btn-info">Editar</a>
                                <a href="{{ route('plan_details.show', [$plan->url, $detail->id]) }}" class="btn btn-warning">Ver</a>
                            </td>
                        </tr>
                    @empty
                        <tr>Nenhuma detalhe encontrado.</tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $pagination !!}
        </div>
    </div>
@stop
