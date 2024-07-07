<!DOCTYPE html>
<html>
<head>
    <title>Crear Cuenta</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Crear cuenta</h1>

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

    <form method="POST" action="{{ route('usuarios.store') }}">
        @csrf
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
        <label>Seleccione su institución de pertenencia</label><br>
        <select name="idInstitucion" id="idInstitucion" onchange=checkRectorStatus()>
                <option value="opcion">Seleccionar</option>
            @foreach ($instituciones as $institucion)
                <option value="{{ $institucion->idInstitucion }}" {{ old('idInstitucion') == $institucion->idInstitucion ? 'selected' : '' }}>{{ $institucion->nombreInstitucion }}</option>
            @endforeach
        </select><br>
        <label>Seleccione su rol o área de trabajo</label><br>
        <select name="rolUsuario" id="rolUsuario" >
            @foreach ($roles as $rol)
                <option value="{{ $rol }}" {{ old('rolUsuario') == $rol ? 'selected' : '' }}>{{ $rol }}</option>
            @endforeach
        </select><br>
        <input type="submit" value="Registrarse"><br>
    </form>
    <button onclick="window.location.href='{{ route('index') }}'">Volver</button><br>
    <label>Registre su institución aquí -><a href="{{ route('registerinst') }}">afiliarse</a></label>

    <script>
        function checkRectorStatus() {
            var idInstitucion = $('#idInstitucion').val();
            console.log('Verificando el estado del rector para la institución ID:', idInstitucion);
            $.ajax({
                url: '{{ route("check.rector.status") }}',
                method: 'GET',
                data: { idInstitucion: idInstitucion },
                success: function(response) {
                    console.log('Respuesta del servidor:', response);
                    if (response.rector_exists) {
                        console.log('El rol de rector existe, ocultando la opción.');
                        $('#rolUsuario option[value="rectores_institucion"]').hide();
                        
                    } else {
                        console.log('El rol de rector no existe, mostrando la opción.');
                        $('#rolUsuario option[value="rectores_institucion"]').show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                }
            });
        }
    </script>
</body>
</html>
