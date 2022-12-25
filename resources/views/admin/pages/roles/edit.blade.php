@extends('adminlte::page')

@section('title', "Editar o cargo {$role->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Cargos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.show', $role->id) }}">{{ $role->name }}</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
    <h1>Editar o cargo {{ $role->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('roles.update', $role->id) }}" method="post" class="form">
                @method('PUT')
                @include('admin.pages.roles._partials.form')
            </form>
        </div>
    </div>
@stop
