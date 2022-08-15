@extends('adminlte::page')

@section('title', "Editar detalhe do plano {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item">
            <a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('plan_details.index', $detail->id) }}">{{ $detail->name }}</a>
        </li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
    <h1>Editar detalhe do plano {{ $plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plan_details.update', [$plan->url, $detail->id]) }}" method="POST">
                @method('PUT')
                @include('admin.pages.plan-details._partials.form')
            </form>
        </div>
    </div>
@stop
