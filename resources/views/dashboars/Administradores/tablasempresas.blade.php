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
            <h1>Empresas</h1>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Empresa</th>
                            <th scope="col">Tipo de Empresa</th>
                            <th scope="col">Área</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Correo</th>
                            <th scope="col">RFC</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empresas as $empresa)
                        <tr id="empresa-row-{{ $empresa->id_empresa }}">
                            <td>{{ $empresa->nombreEmpresa }}</td>
                            <td>{{ $empresa->tipoEmpresa }}</td>
                            <td>{{ $empresa->areaEmpresa }}</td>
                            <td>{{ $empresa->direccionEmpresa }}</td>
                            <td>{{ $empresa->correoEmpresa }}</td>
                            <td>{{ $empresa->rfcEmpresa }}</td>
                            <td>
                                <a href="{{ route('admin.editempresas', $empresa->id_empresa) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('empresas.destroy', $empresa->id_empresa) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta empresa?')">
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
