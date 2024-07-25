@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Usuario</h1>
    <form method="POST" action="{{ route('usuarios.register') }}">
        @csrf
        <div class="mb-3">
            <label for="nombreUsuario" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" required>
        </div>
        <div class="mb-3">
            <label for="apellidoPaterno" class="form-label">Apellido Paterno</label>
            <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno" required>
        </div>
        <div class="mb-3">
            <label for="apellidoMaterno" class="form-label">Apellido Materno</label>
            <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno">
        </div>
        <div class="mb-3">
            <label for="telefonoUsuario" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefonoUsuario" name="telefonoUsuario" required>
        </div>
        <div class="mb-3">
            <label for="correoUsuario" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="correoUsuario" name="correoUsuario" required>
        </div>
        <div class="mb-3">
            <label for="passwordUsuario" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="passwordUsuario" name="passwordUsuario" required>
        </div>
        <div class="mb-3">
            <label for="evaluacionUsuario" class="form-label">Evaluación</label>
            <input type="number" class="form-control" id="evaluacionUsuario" name="evaluacionUsuario">
        </div>
        <div class="mb-3">
            <label for="curriculumUsuario" class="form-label">Curriculum</label>
            <input type="text" class="form-control" id="curriculumUsuario" name="curriculumUsuario">
        </div>
        <div class="mb-3">
            <label for="id_empresa" class="form-label">Empresa</label>
            <select class="form-select" id="id_empresa" name="id_empresa" required>
                <!-- Asumiendo que cargarás las empresas desde el controlador -->
                @foreach($empresas as $empresa)
                    <option value="{{ $empresa->id_empresa }}">{{ $empresa->nombreEmpresa }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_rol" class="form-label">Rol</label>
            <select class="form-select" id="id_rol" name="id_rol" required>
                <!-- Asumiendo que cargarás los roles desde el controlador -->
                @foreach($roles as $rol)
                    <option value="{{ $rol->id_rol }}">{{ $rol->nombreRol }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
    <a href="{{url()->previous()}}">Volver</a>
</div>
@endsection
