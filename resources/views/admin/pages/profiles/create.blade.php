@extends('adminlte::page')

@section('title', 'Cadastrar Novo Perfil')

@section('content_header')
    <h1>Cadastrar Novo Perfil</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profiles.store') }}"
                  method="post"
                  class="form">
                @include('admin.pages.profiles._partials.form')
            </form>
        </div>
    </div>
@stop
