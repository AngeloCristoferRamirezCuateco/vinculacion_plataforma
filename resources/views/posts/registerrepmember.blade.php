<!DOCTYPE html>
<html>
<head>
    <title>Registro de Instituciones</title>
</head>
<body>
    <h1>Registre su Institución</h1>
    <div>
        ¡Advertencia!, Después de ingresar los datos de la institución será redirigido a un formulario de registro de representante.
    </div>
    <form method="POST" action="{{ route('instituciones.store') }}">
        @csrf
        <label>Nombre de la institución o razón social</label><br>
        <input type="text" name="nombreInstitucion"><br>
        <label>Seleccione el tipo de institución</label><br>
        <select name="tipoInstitucion">
            <option>Educativa Superior</option>
            <option>Empresarial</option>
            <option>Gubernamental</option>
            <option>Sin fines de lucro</option>
        </select><br>
        <label>Seleccione la disposición de la institución</label><br>
        <select name="disposicionInstitucion">
            <option>Publica</option>
            <option>Privada</option>
        </select><br>
        <label>Numero telefónico</label><br>
        <input type="text" name="telefonoInstitucion"><br>
        <Label>Correo de la institución</Label><br>
        <input type="email" name="correoInstitucion"><br>
        <label>Contraseña</label><br>
        <input type="password" name="passwordInstitucion"><br>
        <label>Verificar Contraseña</label><br>
        <input type="password" name="passwordInstitucion_confirmation"><br>
        <input type="submit" value="Siguiente paso">
    </form>
</body>
</html>
