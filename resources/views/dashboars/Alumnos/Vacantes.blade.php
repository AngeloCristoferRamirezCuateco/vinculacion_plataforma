@include ('share3.head')
@vite(['resources/scss/theme.scss', 'resources/scss/user.scss', 'resources/js/app.js'])

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
        @include ('share3.nav')
        <div class="content">
            @include ('share3.nav_profile')
            <div class="container mt-4 p-4" style="background-color: #fff; border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <h1 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">PROYECTOS A SOLICITAR</h1>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Proyecto Disponible</th>
                                <th scope="col">Empresa</th>
                                <th scope="col">Vacantes</th>
                                <th scope="col">Datos</th>
                                <th scope="col">Estado de Vacante</th>
                                <th scope="col">Aplicar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($vacantes)
                            @foreach ($vacantes as $vacante)
                            <tr id="user-row-{{ $vacante->id_vacante }}">
                                <td>{{ $vacante->proyectoDisponible }}</td>
                                <td>{{ $vacante->id_empresa }}</td>
                                <td>{{ $vacante->numeroVacantes }}</td>
                                <td>{{ $vacante->datosVacante }}</td>
                                <td>{{ $vacante->estadoVacante }}</td>
                                <td>
                                    <!-- Formulario para aplicar a la vacante -->
                                    <form action="{{ route('aplicaciones.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_vacante" value="{{ $vacante->id_vacante }}">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-user-plus"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @include ('share3.footer')

            @include ('share3.btn-config')
        </div>
    </div>
</main>