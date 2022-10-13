@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Mesas</li>
    </ol>
    <h1>Mesas <a href="{{ route('tables.create') }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> Add</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('tables.search') }}"
                  method="GET"
                  class="form form-inline">
                <input type="text"
                       name="filter"
                       placeholder="Nome"
                       class="form-control"
                       value="{{ request()->filter }}"
                       minlength="2">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table-condensed table">
                <thead>
                    <tr>
                        <th>Identificação</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tables as $table)
                        <tr>
                            <td>{{ $table->identify }}</td>
                            <td>{{ $table->description }}</td>
                            <td>
                                <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-info">Editar</a>
                                <a href="{{ route('tables.show', $table->id) }}" class="btn btn-warning">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $pagination !!}
        </div>
    </div>
@stop
