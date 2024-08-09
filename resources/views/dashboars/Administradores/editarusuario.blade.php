@include('share.head')
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
        @include('share.nav')
        <div class="content">
            @include('share.nav_profile')
            <div class="container mt-4 p-4" style="background-color: #fff; border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('usuarios.update', $usuario->id_usuario) }}">
                @csrf
                @method('PUT')
                <h1 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">EDITAR USUARIO</h1>
                <div class="col-md-6">
                    <label class="form-label fw-bold fs-8" for="nombreUsuario">Nombre</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="nombreUsuario" name="nombreUsuario" type="text" value="{{ $usuario->nombreUsuario }}" required />
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold fs-8" for="apellidoPaterno">Apellido Paterno</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="apellidoPaterno" name="apellidoPaterno" type="text" value="{{ $usuario->apellidoPaterno }}" required />
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold fs-8" for="apellidoMaterno">Apellido Materno</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="apellidoMaterno" name="apellidoMaterno" type="text" value="{{ $usuario->apellidoMaterno }}" required />
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold fs-8" for="correoUsuario">Email</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="correoUsuario" name="correoUsuario" type="email" value="{{ $usuario->correoUsuario }}" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="idInstitucion">Institución</label>
                    <select class="form-control border-primary" style="border-radius: 50px;" id="idInstitucion" name="id_empresa" required>
                        @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id_empresa }}" {{ $usuario->id_empresa == $empresa->id_empresa ? 'selected' : '' }}>
                            {{ $empresa->nombreEmpresa }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8"for="id_rol">Rol del Usuario</label>
                    <select class="form-control border-primary" style="border-radius: 50px;" id="id_rol" name="id_rol" required>
                        @foreach ($roles as $rol)
                        <option value="{{ $rol->id_rol }}" {{ $usuario->id_rol == $rol->id_rol ? 'selected' : '' }}>
                            {{ $rol->nombreRol }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="telefonoUsuario">Teléfono</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="telefonoUsuario" name="telefonoUsuario" type="tel" value="{{ $usuario->telefonoUsuario }}" required />
                </div>
                <div class="col-6">
                    <button class="btn btn-primary col-md-12" style="border-radius: 50px;" onclick="window.location.href='{{redirect()->back()}}'">Volver</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-success col-md-12" style="border-radius: 50px;" type="submit">Actualizar</button>
                </div>
                </div>
            </form>
            @include('share.footer')
            @include('share.btn-config')
        </div>
    </div>
</main>