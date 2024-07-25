<!DOCTYPE html>
<html>
    <head>
        <title>Panel de control</title> 
    </head>
    <body>
        <label for="">Bienvenido administrador</label><br><br>
        <label>Acciones para usuarios</label><br>
        <ul>
            <li><a href="{{route('admin.panelregisteruser')}}">Registrar Usuarios</a></li>
            <li><a>Modificar Usuarios</a></li>
            <li><a>Listar Usuarios</a></li>
            <li><a>Eliminar Usuarios</a></li>
        </ul><br>
        <label>Acciones para empresas</label><br>
        <ul>
            <li><a href="{{route('admin.panelregisterempresa')}}">Registrar Empresas</a></li>
            <li><a>Modificar Empresas</a></li>
            <li><a>Listar Empresas</a></li>
            <li><a>Eliminar Empresas</a></li>
        </ul>
    </body>
</html>