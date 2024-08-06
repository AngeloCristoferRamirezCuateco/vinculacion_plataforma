@include ('share.head')
<main class="main" id="top">
    <div class="container" data-layout="container">
        <script>
            var isFluid = JSON.parse(localStorage.getItem('isFluid'));
            if (isFluid) {
                var container = document.querySelector('[data-layout]');
                container.classList.remove('container');
                container.classList.add('container-fluid');
            }
        </script>
        @include ('share.nav')
        <div class="content">
            @include ('share.nav_profile')
            <h1>Usuarios</h1>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellido Paterno</th>
                            <th scope="col">Apellido Materno</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $user)
                        <tr id="user-row-{{ $user->id_usuario }}">
                            <td>{{ $user->nombreUsuario }}</td>
                            <td>{{ $user->apellidoPaterno }}</td>
                            <td>{{ $user->apellidoMaterno }}</td>
                            <td>{{ $user->correoUsuario }}</td>
                            <td>{{ $user->telefonoUsuario }}</td>
                            <td>
                                <a href="{{ route('admin.editusers', $user->id_usuario) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('usuarios.destroy', $user->id_usuario) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @include ('share.footer')
        </div>
        @include ('share.btn-config')
    </div>
</main>

<script>
    function fillForm(userId) {
        const row = document.getElementById(`user-row-${userId}`);
        const nombreUsuario = row.cells[0].innerText;
        const apellidoPaterno = row.cells[1].innerText;
        const apellidoMaterno = row.cells[2].innerText;
        const correoUsuario = row.cells[3].innerText;

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
