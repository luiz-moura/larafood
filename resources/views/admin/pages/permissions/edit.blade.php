@extends('adminlte::page')

@section('title', "Editar a permissão {$permission->name}")

@section('content_header')
    <h1>Editar a permissão {{ $permission->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.update', $permission->id) }}"
                  method="post"
                  class="form">
                @method('PUT')
                @include('admin.pages.permissions._partials.form')
            </form>
        </div>
    </div>
@stop
