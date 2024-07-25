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
            <form class="row g-3 needs-validation" novalidate="" method="POST" action="{{ route('empresas.register') }}">
                @csrf
                <h1>Registro de Empresas</h1>
                <div class="col-md-4">
                    <label class="form-label" for="nombreEmpresa">Nombre de la Empresa</label>
                    <input class="form-control" id="nombreEmpresa" name="nombreEmpresa" type="text" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="tipoEmpresa">Tipo de Empresa</label>
                    <select class="form-control" id="tipoEmpresa" name="tipoEmpresa" required>
                        <option value="Universidad">Universidad</option>
                        <option value="Textil">Textil</option>
                        <option value="Farmaceutica">Farmaceutica</option>
                        <option value="Bienes Raices">Bienes Raices</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="fechaCreacion">Fecha de Fundación</label>
                    <input class="form-control" id="fechaCreacion" name="fechaCreacion" type="date" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="areaEmpresa">Área de la Empresa</label>
                    <input class="form-control" id="areaEmpresa" name="areaEmpresa" type="text" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="correoEmpresa">Email</label>
                    <input class="form-control" id="correoEmpresa" name="correoEmpresa" type="email" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="passwordEmpresa">Password</label>
                    <input class="form-control" id="passwordEmpresa" name="passwordEmpresa" type="password" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="rfcEmpresa">RFC</label>
                    <input class="form-control" id="rfcEmpresa" name="rfcEmpresa" type="text" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="evaluacionEmpresa">Evaluación</label>
                    <input class="form-control" id="evaluacionEmpresa" name="evaluacionEmpresa" type="number" min="1" max="10" />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="direccionEmpresa">Dirección</label>
                    <input class="form-control" id="direccionEmpresa" name="direccionEmpresa" type="text" required />
                </div>
                <h2>Datos del Representante</h2>
                <div class="col-md-4">
                    <label class="form-label" for="nombreRepresentante">Nombre del Representante</label>
                    <input class="form-control" id="nombreRepresentante" name="nombreRepresentante" type="text" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="apellidoPaternoRepresentante">Apellido Paterno</label>
                    <input class="form-control" id="apellidoPaternoRepresentante" name="apellidoPaternoRepresentante" type="text" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="apellidoMaternoRepresentante">Apellido Materno</label>
                    <input class="form-control" id="apellidoMaternoRepresentante" name="apellidoMaternoRepresentante" type="text" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="correoRepresentante">Email del Representante</label>
                    <input class="form-control" id="correoRepresentante" name="correoRepresentante" type="email" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="passwordRepresentante">Password del Representante</label>
                    <input class="form-control" id="passwordRepresentante" name="passwordRepresentante" type="password" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="telefonoRepresentante">Teléfono del Representante</label>
                    <input class="form-control" id="telefonoRepresentante" name="telefonoRepresentante" type="tel" required />
                </div>
                <!-- Eliminar el campo id_rol del formulario ya que se fuerza en el controlador -->
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Enviar</button>
                </div>
            </form>
            @include ('share.footer')
            @include ('share.btn-config')
        </div>
    </div>
</main>
