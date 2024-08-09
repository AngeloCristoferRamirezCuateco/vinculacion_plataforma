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
                <h1 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">Vacantes Creadas por la Empresa</h1>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">ID Vacante</th>
                                <th scope="col">Nombre del Proyecto</th>
                                <th scope="col">Fecha de Creación</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vacantes as $vacante)
                            <tr>
                                <td>{{ $vacante->id_vacante }}</td>
                                <td>{{ $vacante->proyectoDisponible }}</td>
                                <td>{{ $vacante->created_at->format('d/m/Y') }}</td>
                                <td>{{ $vacante->descripcion }}</td>
                                <td>
                                    <!-- Botón de actualización -->
                                    <a href="{{ route('vacantes.edit', $vacante->id_vacante) }}" class="btn btn-warning btn-sm">Actualizar</a>

                                    <!-- Formulario de eliminación -->
                                    <form action="{{ route('vacantes.destroy', $vacante->id_vacante) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No hay vacantes disponibles.</td>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
