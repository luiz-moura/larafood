@extends('adminlte::page')

@section('title', "Adicionar novo detalhe ao plano {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plan_details.index', $plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item active">Criar</li>
    </ol>
    <h1>Adicionar novo detalhe ao plano {{ $plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plan_details.store', $plan->url) }}" method="POST">
                @include('admin.pages.plans.plan-details._partials.form')
            </form>
        </div>
    </div>
@stop
