@include ('share2.head')
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
        @include ('share2.nav')
        <div class="content">
            @include ('share2.nav_profile')
            <div class="container mt-4 p-4" style="background-color: #fff; border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h1 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">ALUMNOS</h1>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Nombre Proyecto</th>
                            <th scope="col">Empresa<th>
                            <th scope="col">Alumno<th>
                            <th scope="col">Apellido Paterno<th>
                            <th scope="col">Apellido Materno<th>
                     
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($vacantes as $vacante)
                            <tr id="user-row-{{ $vacante->id_vacante }}">
                                <td>{{ $user->proyectoDisponible }}</td>
                                <td>{{ $user->id_empresa }}</td>
                                <td>{{ $user->id_vacante }}</td>
                                <td>{{ $user->apellidoPaterno }}</td>
                                <td>{{ $user->apellidoMaterno }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">No se encontraron usuarios.</td>
                            </tr>
                        @endif
                    </tbody>
                    
                </table>
            </div>
            </div>
            @include ('share2.footer')
        </div>
        @include ('share2.btn-config')
    </div>
</main>
