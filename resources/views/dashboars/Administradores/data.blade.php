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
            <h1>Dashboard</h1>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Total de Usuarios</div>
                        <div class="card-body">{{ $totalUsuarios }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Total de Empresas</div>
                        <div class="card-body">{{ $totalEmpresas }}</div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Usuarios por Rol</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Rol</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($usuariosPorRol as $rol)
                                    <tr>
                                        <td>{{ $rol->id_rol }}</td>
                                        <td>{{ $rol->total }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Crecimiento de Usuarios por Mes</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Año</th>
                                        <th>Mes</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($usuariosPorMes as $mes)
                                    <tr>
                                        <td>{{ $mes->year }}</td>
                                        <td>{{ $mes->month }}</td>
                                        <td>{{ $mes->total }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @include ('share.footer')
        </div>
        @include ('share.btn-config')
    </div>
</main>
