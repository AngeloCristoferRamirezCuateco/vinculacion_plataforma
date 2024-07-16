@extends('layouts.app')

@section('title', 'Crear Empresa')

@section('content')
    <div class="container">
        <h2>Registrar Nueva Empresa</h2>
        <form action="{{ route('empresas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombreEmpresa">Nombre</label>
                <input type="text" name="nombreEmpresa" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tipoEmpresa">Tipo</label>
                <input type="text" name="tipoEmpresa" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fechaCreacion">Fecha de Creación</label>
                <input type="date" name="fechaCreacion" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="areaEmpresa">Área</label>
                <input type="text" name="areaEmpresa" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="representanteEmpresa">Representante</label>
                <input type="text" name="representanteEmpresa" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="direccionEmpresa">Dirección</label>
                <input type="text" name="direccionEmpresa" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="rfcEmpresa">RFC</label>
                <input type="text" name="rfcEmpresa" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="evaluacionEmpresa">Evaluación</label>
                <input type="number" name="evaluacionEmpresa" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
