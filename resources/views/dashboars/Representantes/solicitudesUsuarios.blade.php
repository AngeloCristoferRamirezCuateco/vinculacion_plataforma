@include('share1.head')

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
        @include('share1.nav')
        <div class="content">
            @include('share1.nav_profile')
            <div class="container mt-4 p-4" style="background-color: #fff; border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <h1 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">SOLICITUDES DE VACANTES</h1>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Vacante</th>
                                <th scope="col">Nombre del Usuario</th>
                                <th scope="col">Fecha de Aplicación</th>
                                <th scope="col">Estado de la Solicitud</th>
                                <th scope="col">Currículum</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($solicitudes as $solicitud)
                            <tr>
                                <td>{{ $solicitud->vacante->proyectoDisponible }}</td>
                                <td>{{ $solicitud->usuario->nombreUsuario }} {{ $solicitud->usuario->apellidoPaterno }}</td>
                                <td>{{ $solicitud->fechaAplicacion }}</td>
                                <td>{{ $solicitud->estadoSolicitud }}</td>
                                <td>
                                    @if($solicitud->curriculumUsuario)
                                    <a href="{{ route('download.curriculum', $solicitud->id_aplicante) }}" class="btn btn-primary btn-sm">Descargar</a>
                                    @else
                                    No disponible
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('solicitudes.aceptar', $solicitud->id_aplicante) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm">Aceptar</button>
                                    </form>
                                    <form action="{{ route('solicitudes.rechazar', $solicitud->id_aplicante) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Rechazar</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay solicitudes disponibles.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('share1.footer')
        @include('share1.btn-config')
    </div>
</main>