@extends('adminlte::page')

@section('title', "Detalhes da empresa $tenant->name")

@section('content_header')
    <h1>Detalhes da empresa <b>{{ $tenant->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Empresa</h3>

            <ul>
                <li>
                    <strong>Imagem: </strong>
                    <img src="{{ url("storage/{$tenant->logo}") }}"
                         alt="{{ $tenant->name }}"
                         style="max-width: 90px">
                </li>
                <li><strong>Plano: </strong> {{ $tenant->plan->name }}</li>
                <li><strong>Nome: </strong> {{ $tenant->name }}</li>
                <li><strong>url: </strong> {{ $tenant->url }}</li>
                <li><strong>Email: </strong> {{ $tenant->email }}</li>
                <li><strong>CNPJ: </strong> {{ $tenant->cnpj }}</li>
                <li><strong>Ativo: </strong> {{ $tenant->active->value }}</li>
            </ul>

            <hr>

            <h3>Assinatura</h3>

            <ul>
                <li><strong>Data Assinatura: </strong> {{ $tenant->subscribed_at }}</li>
                <li><strong>Data Expiração: </strong> {{ $tenant->expires_at }}</li>
                <li><strong>Identifacador: </strong> {{ $tenant->subscription_id }}</li>
                <li><strong>Ativo: </strong> {{ $tenant->subscription_active }}</li>
                <li><strong>Cancelou: </strong> {{ $tenant->subscription_suspended }}</li>
            </ul>
        </div>
    </div>
@stop
