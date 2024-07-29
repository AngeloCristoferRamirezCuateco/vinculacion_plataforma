@include ('share.head')
<main class="main" id="top">
    <div class="container" data-layout="container">
        @include ('share.nav')
        <div class="content">
            @include ('share.nav_profile')
            <h1>Usuarios</h1>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Seleccionar</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellido Paterno</th>
                            <th scope="col">Apellido Materno</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alumnos->where('id_empresa', $representante->id_empresa)
                                          ->whereIn('id_usuario', $usuariosRol->where('rol', 'alumno')->pluck('id_usuario')) as $user)
                        <tr id="user-row-{{ $user->id_usuario }}">
                            <td><input type="radio" name="selectedUser" onclick="fillForm({{ $user->id_usuario }})"></td>
                            <td>{{ $user->nombreUsuario }}</td>
                            <td>{{ $user->apellidoPaterno }}</td>
                            <td>{{ $user->apellidoMaterno }}</td>
                            <td>{{ $user->correoUsuario }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <form id="update-form" method="POST" action="{{ route('usuarios.update', 0) }}">
                @csrf
                @method('PUT')
                <h2>Editar Usuario</h2>
                <input type="hidden" name="id_usuario" id="form-id_usuario">
                <div class="col-md-4">
                    <label class="form-label" for="form-nombreUsuario">Nombre</label>
                    <input class="form-control" id="form-nombreUsuario" name="nombreUsuario" type="text" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="form-apellidoPaterno">Apellido Paterno</label>
                    <input class="form-control" id="form-apellidoPaterno" name="apellidoPaterno" type="text" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="form-apellidoMaterno">Apellido Materno</label>
                    <input class="form-control" id="form-apellidoMaterno" name="apellidoMaterno" type="text" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="form-correoUsuario">Email</label>
                    <input class="form-control" id="form-correoUsuario" name="correoUsuario" type="email" required />
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Actualizar</button>
                </div>
            </form>

            @include ('share.footer')
        </div>
        @include ('share.btn-config')
    </div>
</main>

<script>
    function fillForm(userId) {
        const row = document.getElementById(`user-row-${userId}`);
        const nombreUsuario = row.cells[1].innerText;
        const apellidoPaterno = row.cells[2].innerText;
        const apellidoMaterno = row.cells[3].innerText;
        const correoUsuario = row.cells[4].innerText;

        document.getElementById('form-id_usuario').value = userId;
        document.getElementById('form-nombreUsuario').value = nombreUsuario;
        document.getElementById('form-apellidoPaterno').value = apellidoPaterno;
        document.getElementById('form-apellidoMaterno').value = apellidoMaterno;
        document.getElementById('form-correoUsuario').value = correoUsuario;

        // Update form action
        const form = document.getElementById('update-form');
        form.action = form.action.replace(/\/\d+$/, `/${userId}`);
    }
</script>
