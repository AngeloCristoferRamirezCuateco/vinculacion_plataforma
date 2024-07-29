@include ('share1.head')
<body>
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
                <form class="row g-3 needs-validation" method="POST" action="#">
                    @csrf
                    <h1>Registro de Usuarios</h1>
                    
                    <div class="col-md-4">
                        <label class="form-label" for="nombreUsuario">Nombre</label>
                        <input class="form-control" id="nombreUsuario" name="nombreUsuario" type="text" required />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="apellidoPaterno">Apellido Paterno</label>
                        <input class="form-control" id="apellidoPaterno" name="apellidoPaterno" type="text" required />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="apellidoMaterno">Apellido Materno</label>
                        <input class="form-control" id="apellidoMaterno" name="apellidoMaterno" type="text" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="correoUsuario">Email</label>
                        <input class="form-control" id="correoUsuario" name="correoUsuario" type="email" required />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="passwordUsuario">Password</label>
                        <input class="form-control" id="passwordUsuario" name="passwordUsuario" type="password" required />
                    </div>
                    <!-- <div class="col-md-4">
                        <label class="form-label" for="id_empresa">Institución</label>
                        <select class="form-control" id="id_empresa" name="id_empresa" required>
                        </select>   
                    </div> -->
                    <div class="col-md-4">
                        <label class="form-label" for="id_rol">Rol del Usuario</label>
                        <select class="form-control" id="id_rol" name="id_rol" required>
                            <option>Alumno</option>
                            <option>Docente</option>
                        </select>   
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="telefonoUsuario">Teléfono</label>
                        <input class="form-control" id="telefonoUsuario" name="telefonoUsuario" type="tel" required />
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Enviar</button>
                    </div>
                </form>
                @include ('share1.footer')
                @include ('share1.btn-config')
            </div>
        </div>
    </main>
</body>