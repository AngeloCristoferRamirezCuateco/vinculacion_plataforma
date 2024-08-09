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
            <div class="container mt-4 p-4" style="background-color: #fff; border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <form ID="registroForm" class="row g-3 needs-validation" method="POST" action="{{ route('usuarios.register') }}">
                @csrf
                <h1 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">REGISTRO DE USUARIOS</h1>
                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="nombreUsuario">Nombre</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="nombreUsuario" name="nombreUsuario" type="text" required />
                    <span id="errorNombre" class="error text-danger"></span>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="apellidoPaterno">Apellido Paterno</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="apellidoPaterno" name="apellidoPaterno" type="text" required />
                    <span id="errorApellidoPaterno" class="error text-danger"></span>
                    </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="apellidoMaterno">Apellido Materno</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="apellidoMaterno" name="apellidoMaterno" type="text" />
                    <span id="errorApellidoMaterno" class="error text-danger"></span>

                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="correoUsuario">Email</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="correoUsuario" name="correoUsuario" type="email" required />
                    <span id="errorCorreo" class="error text-danger"></span>

                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="passwordUsuario">Password</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="passwordUsuario" name="passwordUsuario" type="password" required />
                    <span id="errorPassword" class="error text-danger"></span>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="id_empresa">Institución</label>
                    <select class="form-control border-primary" style="border-radius: 50px;" id="id_empresa" name="id_empresa" required>
                        @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id_empresa }}">{{ $empresa->nombreEmpresa }}</option>
                        @endforeach
                    </select>   
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold fs-8" for="id_rol">Rol del Usuario</label>
                    <select class="form-control border-primary" style="border-radius: 50px;" id="id_rol" name="id_rol" required>
                        @foreach ($roles as $rol)
                        <option value="{{ $rol->id_rol }}">{{ $rol->nombreRol }}</option>
                        @endforeach
                    </select>   
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold fs-8" for="telefonoUsuario">Teléfono</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="telefonoUsuario" name="telefonoUsuario" type="tel" required />
                    <span id="errorTelefono" class="error text-danger"></span>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <button class="btn btn-primary w-50 py-2" style="border-radius: 50px;" type="submit">Enviar</button>
                </div>
            </form>
            </div>
            @include ('share.footer')
            @include ('share.btn-config')
        </div>
    </div>
</main>
<script>
document.getElementById('registroForm').addEventListener('submit', function(event) {
    // Evitar el envío del formulario si hay errores
    event.preventDefault();

    // Obtener los campos del formulario
    var nombreUsuario = document.getElementById('nombreUsuario');
    var apellidoPaterno = document.getElementById('apellidoPaterno');
    var apellidoMaterno = document.getElementById('apellidoMaterno');
    var telefonoUsuario = document.getElementById('telefonoUsuario');
    var correoUsuario = document.getElementById('correoUsuario');
    var passwordUsuario = document.getElementById('passwordUsuario');

    // Borrar mensajes de error previos
    clearErrors();

    // Validar campos
    var isValid = true;

    // Validar nombre (solo letras y espacios)
    if (!/^[a-zA-Z\s]+$/.test(nombreUsuario.value)) {
        showError('errorNombre', 'El nombre solo puede contener letras y espacios.');
        isValid = false;
    }

    // Validar apellido paterno (solo letras y espacios)
    if (!/^[a-zA-Z\s]+$/.test(apellidoPaterno.value)) {
        showError('errorApellidoPaterno', 'El apellido paterno solo puede contener letras y espacios.');
        isValid = false;
    }

    // Validar apellido materno (solo letras y espacios)
    if (apellidoMaterno.value !== "" && !/^[a-zA-Z\s]+$/.test(apellidoMaterno.value)) {
        showError('errorApellidoMaterno', 'El apellido materno solo puede contener letras y espacios.');
        isValid = false;
    }

    // Validar teléfono (exactamente 10 dígitos)
    if (!/^\d{10}$/.test(telefonoUsuario.value)) {
        showError('errorTelefono', 'El número de teléfono debe tener exactamente 10 dígitos.');
        isValid = false;
    }

    // Validar correo electrónico
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correoUsuario.value)) {
        showError('errorCorreo', 'Por favor, introduce un correo electrónico válido.');
        isValid = false;
    }

    // Validar contraseña (mínimo 8 caracteres)
    if (passwordUsuario.value.length < 8) {
        showError('errorPassword', 'La contraseña debe tener al menos 8 caracteres.');
        isValid = false;
    }

    // Si todas las validaciones son correctas, enviar el formulario
    if (isValid) {
        this.submit();
    }
});

function showError(elementId, message) {
    document.getElementById(elementId).textContent = message;
}

function clearErrors() {
    var errorElements = document.querySelectorAll('.error');
    errorElements.forEach(function(element) {
        element.textContent = '';
    });
}

</script>