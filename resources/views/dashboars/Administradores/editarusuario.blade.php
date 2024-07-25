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
            <form class="row g-3 needs-validation" novalidate="">
                <h1>Registro de Usuarios</h1>
                <div class="col-md-4">
                    <label class="form-label" for="nombre">Nombre</label>
                    <input class="form-control" id="nombre" type="text" required="" />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="apellidoPaterno">Apellido Paterno</label>
                    <input class="form-control" id="apellidoPaterno" type="text" required="" />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="apellidoMaterno">Apellido Materno</label>
                    <input class="form-control" id="apellidoMaterno" type="text" required="" />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="correoUsuario">Email</label>
                    <input class="form-control" id="correoUsuario" type="email" aria-describedby="inputGroupPrepend" required="" />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="idInstitucion">Institución</label>
                    <select class="form-control" id="idInstitucion" name="idInstitucion" required>
                        <option value="BUAP">BUAP</Option>
                        <option value="UTP">UTP</Option>
                        <option value="ITP">ITP</Option>
                        <option value="UVP">UVP</Option>
                    </select>   
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="id_rol">Rol del Usuario</label>
                    <select class="form-control" id="id_rol" name="id_rol" required>
                        <option value="Alumno">Alumno</Option>
                        <option value="Docente">Docente</Option>
                        <option value="Administrador">Administrador</Option>
                        <option value="Representante">Representante</Option> 
                    </select>   
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="telefono">Teléfono</label>
                    <input class="form-control" id="telefono" type="tel" required="" />
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Enviar</button>
                </div>
            </form>
            @include ('share.footer')
            @include ('share.btn-config')
        </div>
    </div>
</main>
