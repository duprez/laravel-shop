@extends('layouts.main')

@section('title', 'Listado de productos')

@section('content')
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Listado de productos
                    <a href="{{ route('products.create') }}" class="btn btn-success btn-sm float-right">Nuevo producto</a>
                </div>
                <div class="card-body">
                    @if(session('info'))
                        <div class="alert alert-success">
                            {{ session('info') }}
                        </div>
                    @endif
                    <table class="table table-hover table-sm">
                        <thead>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th><th>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td> {{ $product->description }} </td>
                                <td> {{ $product->price }} </td>
                                <th>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-secondary btn-sm">Editar</a>
                                    <a href="javascript: document.getElementById('delete-{{ $product->id }}').submit()" class="btn btn-danger btn-sm">Eliminar</a>
                                    <form id="delete-{{ $product->id }}" action="{{ route('products.delete', $product->id) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                    </form>
                                <td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    Bienvenido {{ auth()->user()->name }}
                    <a href="javascript: document.getElementById('logout').submit()" class="btn btn-danger btn-sm float-right">Cerrar sesión</a>
                    <form action="{{ route('logout') }}" id="logout" style="display:none" method="POST">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection