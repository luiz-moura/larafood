@extends('adminlte::page')

@section('title', 'Cadastrar novo produto')

@section('content_header')
    <h1>Cadastrar novo Produto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.store') }}"
                  method="post"
                  enctype="multipart/form-data"
                  class="form">
                @csrf
                @include('admin.pages.products._partials.form')
            </form>
        </div>
    </div>
@stop
