@extends('adminlte::page')

@section('title', "Editar a mesa {$table->identify}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tables.index') }}">Mesas</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tables.show', $table->id) }}">{{ $table->name }}</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
    <h1>Editar a mesa {{ $table->identify }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tables.update', $table->id) }}" method="post" class="form">
                @method('PUT')
                @include('admin.pages.tables._partials.form')
            </form>
        </div>
    </div>
@stop
