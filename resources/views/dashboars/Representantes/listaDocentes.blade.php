@include('share1.head')

<main class="main" id="top">
    <div class="container" data-layout="container">
        @include('share1.nav')
        <div class="content">
            @include('share1.nav_profile')
            <h1>Lista de docentes</h1>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellido Paterno</th>
                            <th scope="col">Apellido Materno</th>
                            <th scope="col">Email</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($docentes)
                            @foreach ($docentes as $docente)
                                <tr id="user-row-{{ $docente->id_usuario }}">
                                    <td>{{ $docente->nombreUsuario }}</td>
                                    <td>{{ $docente->apellidoPaterno }}</td>
                                    <td>{{ $docente->apellidoMaterno }}</td>
                                    <td>{{ $docente->correoUsuario }}</td>
                                    <td>
                                        <a href="{{ route('representante.editarDocente', $docente->id_usuario) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('usuarios.destroy', $docente->id_usuario) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            @include('share1.footer')
        </div>
        @include('share1.btn-config')
    </div>
</main>
