@extends('adminlte::page')

@section('title', 'Cadastrar nova Permissão')

@section('content_header')
    <h1>Cadastrar nova Permissão</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.store') }}"
                  method="post"
                  class="form">
                @include('admin.pages.permissions._partials.form')
            </form>
        </div>
    </div>
@stop
