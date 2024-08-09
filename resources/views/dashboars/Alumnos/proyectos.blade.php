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
            <h1 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">PROYECTOS</h1>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Nombre Proyecto</th>
                            <th scope="col">Empresa</th>
                            <th scope="col">Docente</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($usuarios) && $usuarios->count() > 0)
                            @foreach ($usuarios as $user)
                            <tr id="user-row-{{ $user->id_usuario }}">
                                <td>{{ $user->nombre_proyecto }}</td>
                                <td>{{ $user->nombreEmpresa }}</td>
                                <td>{{ $user->nombreUsuario }}</td>
                                
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
            @include ('share3.footer')
        </div>
        @include ('share3.btn-config')
    </div>
</main>
