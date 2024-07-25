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
                            <th scope="col">Seleccionar</th>
                            <th scope="col">Empresa</th>
                            <th scope="col">Tipo de Empresa</th>
                            <th scope="col">Area</th>
                            <!--<th scope="col">Representante</th>-->
                            <th scope="col">Dirección</th>
                            <th scope="col">Correo</th>
                            <th scope="col">RFC</th>
                            <th scope="col">Calificación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empresas as $empresa)
                        <tr id="user-row-{{ $empresa->id_empresa }}">
                            <td><input type="radio" name="selectedUser" onclick="fillForm({{ $empresa->id_empresa }})"></td>
                            <td>{{ $empresa->nombreEmpresa }}</td>
                            <td>{{ $empresa->tipoEmpresa }}</td>
                            <td>{{ $empresa->areaEmpresa }}</td>
                            <!--<td>{{ $empresa->representanteEmpresa }}</td>-->
                            <td>{{ $empresa->direccionEmpresa }}</td>
                            <td>{{ $empresa->correoEmpresa }}</td>
                            <td>{{ $empresa->rfcEmpresa }}</td>
                            <td>{{ $empresa->evaluacionEmpresa }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <form id="update-form" method="POST" action="{{ route('empresas.update', 0) }}">
                @csrf
                @method('PUT')
                <h2>Editar Empresa</h2>
                <input type="hidden" name="id_empresa" id="form-id_empresa">
                <div class="col-md-4">
                    <label class="form-label" for="form-nombreEmpresa">Nombre de la Empresa</label>
                    <input class="form-control" id="form-nombreEmpresa" name="nombreEmpresa" type="text" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="form-tipoEmpresa">Tipo de Empresa</label>
                    <input class="form-control" id="form-tipoEmpresa" name="tipoEmpresa" type="text" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="form-areaEmpresa">Área de la Empresa</label>
                    <input class="form-control" id="form-areaEmpresa" name="areaEmpresa" type="text" required />
                </div>
                <!-- <div class="col-md-4">
                    <label class="form-label" for="form-representanteEmpresa">Representante</label>
                    <input class="form-control" id="form-representanteEmpresa" name="representanteEmpresa" type="text" required />
                </div> -->
                <div class="col-md-4">
                    <label class="form-label" for="form-direccionEmpresa">Dirección</label>
                    <input class="form-control" id="form-direccionEmpresa" name="direccionEmpresa" type="text" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="form-correoEmpresa">Correo</label>
                    <input class="form-control" id="form-correoEmpresa" name="correoEmpresa" type="email" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="form-rfcEmpresa">RFC</label>
                    <input class="form-control" id="form-rfcEmpresa" name="rfcEmpresa" type="text" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="form-evaluacionEmpresa">Calificación</label>
                    <input class="form-control" id="form-evaluacionEmpresa" name="evaluacionEmpresa" type="text" required />
                </div><br>
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
    function fillForm(empresaId) {
        const row = document.getElementById(`user-row-${empresaId}`);
        const nombreEmpresa = row.cells[1].innerText;
        const tipoEmpresa = row.cells[2].innerText;
        const areaEmpresa = row.cells[3].innerText;
        //const representanteEmpresa = row.cells[4].innerText;
        const direccionEmpresa = row.cells[4].innerText;
        const correoEmpresa = row.cells[5].innerText;
        const rfcEmpresa = row.cells[6].innerText;
        const evaluacionEmpresa = row.cells[7].innerText;

        document.getElementById('form-id_empresa').value = empresaId;
        document.getElementById('form-nombreEmpresa').value = nombreEmpresa;
        document.getElementById('form-tipoEmpresa').value = tipoEmpresa;
        document.getElementById('form-areaEmpresa').value = areaEmpresa;
        //document.getElementById('form-representanteEmpresa').value = representanteEmpresa;
        document.getElementById('form-direccionEmpresa').value = direccionEmpresa;
        document.getElementById('form-correoEmpresa').value = correoEmpresa;
        document.getElementById('form-rfcEmpresa').value = rfcEmpresa;
        document.getElementById('form-evaluacionEmpresa').value = evaluacionEmpresa;

        // Update form action
        const form = document.getElementById('update-form');
        form.action = form.action.replace(/\/\d+$/, `/${empresaId}`);
    }
</script>
