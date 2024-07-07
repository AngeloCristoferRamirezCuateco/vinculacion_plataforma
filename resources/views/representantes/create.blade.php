<!DOCTYPE html>
<html>
<head>
    <title>Registro de Representantes</title>
</head>
<body>
    <h1>Registrar Representante para {{ $institucion->nombreInstitucion }}</h1>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('representantes.store') }}">
        @csrf
        <input type="hidden" name="idInstitucion" value="{{ $institucion->idInstitucion }}">
        <label>Nombre o nombres</label><br>
        <input type="text" name="nombreUsuario" value="{{ old('nombreUsuario') }}"><br>
        <label>Apellido Paterno</label><br>
        <input type="text" name="apellidoPaterno" value="{{ old('apellidoPaterno') }}"><br>
        <label>Apellido Materno</label><br>
        <input type="text" name="apellidoMaterno" value="{{ old('apellidoMaterno') }}"><br>
        <label>Correo electrónico</label><br>
        <input type="email" name="correoUsuario" value="{{ old('correoUsuario') }}"><br>
        <label>Contraseña</label><br>
        <input type="password" name="passwordUsuario"><br>
        <label>Verificar Contraseña</label><br>
        <input type="password" name="passwordUsuario_confirmation"><br>
        <input type="submit" value="Registrar Representante"><br>
    </form>
</body>
</html>
