@include ('share1.head')
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
        @include ('share1.nav')
        <div class="content">
            @include ('share1.nav_profile')
            <h1>Usuarios</h1>
            <form class="row g-3 needs-validation" novalidate method="POST" action="#">
                @csrf
                @method('PUT')
                <h1>Editar Usuario</h1>
                <div class="col-md-6">
                    <label class="form-label" for="nombreUsuario">Nombre</label>
                    <input class="form-control" id="nombreUsuario" name="nombreUsuario" type="text"  required />
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="apellidoPaterno">Apellido Paterno</label>
                    <input class="form-control" id="apellidoPaterno" name="apellidoPaterno" type="text"  required />
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="apellidoMaterno">Apellido Materno</label>
                    <input class="form-control" id="apellidoMaterno" name="apellidoMaterno" type="text"  required />
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="correoUsuario">Email</label>
                    <input class="form-control" id="correoUsuario" name="correoUsuario" type="email"  required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="idInstitucion">Institución</label>
                    <select class="form-control" id="idInstitucion" name="id_empresa" required>
                        
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="id_rol">Rol del Usuario</label>
                    <select class="form-control" id="id_rol" name="id_rol" required>
                        
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="telefonoUsuario">Teléfono</label>
                    <input class="form-control" id="telefonoUsuario" name="telefonoUsuario" type="tel" value="" required />
                </div>
                <div class="col-6">
                    <button class="btn btn-primary col-md-12" onclick="window.location.href='{{redirect()->back()}}'">Volver</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-success col-md-12" type="submit">Actualizar</button>
                </div>
            </form>
            @include ('share1.footer')
        </div>
        @include ('share1.btn-config')
    </div>
</main>