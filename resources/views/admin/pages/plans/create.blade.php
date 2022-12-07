@extends('adminlte::page')

@section('title', 'Cadastrar Novo Plano')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item active">Criar</li>
    </ol>
    <h1>Cadastrar novo Plano</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.store') }}" method="post" class="form">
                @include('admin.pages.plans._partials.form')
            </form>
        </div>
    </div>
@stop
