@extends('adminlte::page')

@section('title', "Editar detalhe do plano {$planDetail->plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $planDetail->plan->url) }}">{{ $planDetail->plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plan_details.index', $planDetail->plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plan_details.show', [$planDetail->plan->url, $planDetail->id]) }}">{{ $planDetail->name }}</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
    <h1>Editar detalhe do plano {{ $planDetail->plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plan_details.update', [$planDetail->plan->url, $planDetail->id]) }}" method="POST">
                @method('PUT')
                @include('admin.pages.plans.plan-details._partials.form')
            </form>
        </div>
    </div>
@stop
