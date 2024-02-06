@extends('adminlte::page')

@section('title', "Detalhe do plano {$planDetail->plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $planDetail->plan->url) }}">{{ $planDetail->plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plan_details.index', $planDetail->plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item active">{{ $planDetail->name }}</li>
    </ol>
    <h1>Detalhe do plano {{ $planDetail->plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome:</strong> {{ $planDetail->name }}
                </li>
            </ul>
        </div>
        <div class="card-footer">
            <a href="{{ route('plan_details.edit', [$planDetail->plan->url, $planDetail->id]) }}" class="btn btn-info mr-2">Editar</a>
            <form action="{{ route('plan_details.destroy', [$planDetail->plan->url, $planDetail->id]) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Deletar o detalhe {{ $planDetail->name }}, do plano {{ $planDetail->plan->name }}
                </button>
            </form>
        </div>
    </div>
@stop
