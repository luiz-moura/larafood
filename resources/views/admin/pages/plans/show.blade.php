@extends('adminlte::page')

@section('title', "Detalhes do plano $plan->name")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item active">{{ $plan->name }}</li>
    </ol>
    <h1>Detalhes do plano <b>{{ $plan->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: </strong> {{ $plan->name }}</li>
                <li><strong>URL: </strong> {{ $plan->url }}</li>
                <li><strong>Preço: </strong> {{ number_format($plan->price, 2, ',', '.') }}</li>
                <li><strong>Descrição: </strong> {{ $plan->description }}</li>
            </ul>

            <x-alert-errors/>

            <form action="{{ route('plans.destroy', $plan->url) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Deletar o plano <b>{{ $plan->name }}</b>
                </button>
            </form>
        </div>
    </div>
@stop
