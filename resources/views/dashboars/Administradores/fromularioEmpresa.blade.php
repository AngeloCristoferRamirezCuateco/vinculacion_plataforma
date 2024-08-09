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
            <form id="registroForm" class="row g-3 needs-validation" novalidate method="POST" action="{{ route('empresas.register') }}">
                @csrf
                <h1 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">REGISTRO DE EMPRESA</h1>
                
                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="nombreEmpresa">Nombre de la Empresa</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="nombreEmpresa" name="nombreEmpresa" type="text" required />
                    <span id="errorNombreEmpresa" class="error text-danger"></span>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="tipoEmpresa">Tipo de Empresa</label>
                    <select class="form-control border-primary" style="border-radius: 50px;" id="tipoEmpresa" name="tipoEmpresa" required>
                        <option value="Publica">Pública</option>
                        <option value="Privada">Privada</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="fechaCreacion">Fecha de Fundación</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="fechaCreacion" name="fechaCreacion" type="date" required />
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="areaEmpresa">Área de la Empresa</label>
                    <select class="form-control border-primary" style="border-radius: 50px;" id="areaEmpresa" name="areaEmpresa" required>
                        <option value=""></option>
                        <option value="Universidad">Universidad</option>
                        <option value="Farmaceutica">Farmacéutica</option>
                        <option value="Bienes Raices">Bienes Raíces</option>
                        <option value="Textil">Textil</option>
                        <option value="TICS">Tecnologías de la Información (TI)</option>
                        <option value="Marketing">Marketing y Ventas</option>
                        <option value="Legal">Legal</option>
                        <option value="Compras_abastecimiento">Compras y Abastecimiento</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="correoEmpresa">Email</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="correoEmpresa" name="correoEmpresa" type="email" required />
                    <span id="errorCorreoEmpresa" class="error text-danger"></span>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="passwordEmpresa">Password</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="passwordEmpresa" name="passwordEmpresa" type="password" required />
                    <span id="errorPasswordEmpresa" class="error text-danger"></span>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="rfcEmpresa">RFC</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="rfcEmpresa" name="rfcEmpresa" type="text" required />
                    <span id="errorRfcEmpresa" class="error text-danger"></span>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="evaluacionEmpresa">Evaluación</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="evaluacionEmpresa" name="evaluacionEmpresa" type="number" min="1" max="10" />
                    <span id="errorEvaluacionEmpresa" class="error text-danger"></span>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="direccionEmpresa">Dirección</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="direccionEmpresa" name="direccionEmpresa" type="text" required />
                    <span id="errorDireccionEmpresa" class="error text-danger"></span>
                </div>

                <h2 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">DATOS DE REPRESENTANTE</h2>
                
                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="nombreRepresentante">Nombre del Representante</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="nombreRepresentante" name="nombreRepresentante" type="text" required />
                    <span id="errorNombreRepresentante" class="error text-danger"></span>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="apellidoPaternoRepresentante">Apellido Paterno</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="apellidoPaternoRepresentante" name="apellidoPaternoRepresentante" type="text" required />
                    <span id="errorApellidoPaternoRepresentante" class="error text-danger"></span>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="apellidoMaternoRepresentante">Apellido Materno</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="apellidoMaternoRepresentante" name="apellidoMaternoRepresentante" type="text" required />
                    <span id="errorApellidoMaternoRepresentante" class="error text-danger"></span>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="correoRepresentante">Email del Representante</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="correoRepresentante" name="correoRepresentante" type="email" required />
                    <span id="errorCorreoRepresentante" class="error text-danger"></span>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="passwordRepresentante">Password del Representante</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="passwordRepresentante" name="passwordRepresentante" type="password" required />
                    <span id="errorPasswordRepresentante" class="error text-danger"></span>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="telefonoRepresentante">Teléfono del Representante</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="telefonoRepresentante" name="telefonoRepresentante" type="tel" required />
                    <span id="errorTelefonoRepresentante" class="error text-danger"></span>
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

    // Borrar mensajes de error previos
    clearErrors();

    // Obtener los campos del formulario
    var nombreEmpresa = document.getElementById('nombreEmpresa');
    var correoEmpresa = document.getElementById('correoEmpresa');
    var passwordEmpresa = document.getElementById('passwordEmpresa');
    var rfcEmpresa = document.getElementById('rfcEmpresa');
    var nombreRepresentante = document.getElementById('nombreRepresentante');
    var apellidoPaternoRepresentante = document.getElementById('apellidoPaternoRepresentante');
    var apellidoMaternoRepresentante = document.getElementById('apellidoMaternoRepresentante');
    var correoRepresentante = document.getElementById('correoRepresentante');
    var passwordRepresentante = document.getElementById('passwordRepresentante');
    var telefonoRepresentante = document.getElementById('telefonoRepresentante');

    // Validar los campos del formulario
    var valid = true;

    if (nombreEmpresa.value.trim() === '' || !/^[a-zA-Z\s]+$/.test(nombreEmpresa.value.trim())) {
    showError('errorNombreEmpresa', 'El nombre de la empresa es obligatorio y solo puede contener letras y espacios.');
    valid = false;
    }

    if (correoEmpresa.value.trim() === '' || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correoEmpresa.value.trim())) {
    showError('errorCorreoEmpresa', 'El correo de la empresa es erroneo');
    valid = false;
    }

    if (passwordEmpresa.value.trim() === '' || passwordEmpresa.value.length < 8) {
    showError('errorPasswordEmpresa', 'La contraseña es obligatoria y debe tener al menos 8 caracteres.');
    valid = false;
    }

    if (rfcEmpresa.value.trim() === '') {
        showError('errorRfcEmpresa', 'El RFC es obligatorio.');
        valid = false;
    }

    if (nombreRepresentante.value.trim() === '' || !/^[a-zA-Z\s]+$/.test(nombreRepresentante.value.trim())) {
    showError('errornombreRepresentante', 'El nombre del representante es obligatorio y solo puede contener letras y espacios.');
    valid = false;
    }

    if (apellidoPaternoRepresentante.value.trim() === '' || !/^[a-zA-Z\s]+$/.test(apellidoPaternoRepresentante.value.trim())) {
    showError('apellidoPaternoRepresentante', 'El apellido paterno del representante es obligatorio y solo puede contener letras y espacios.');
    valid = false;
    }

    if (apellidoMaternoRepresentante.value.trim() === '' || !/^[a-zA-Z\s]+$/.test(apellidoMaternoRepresentante.value.trim())) {
    showError('errorApellidoMaternoRepresentante', 'El apellido materno es obligatorio y solo puede contener letras y espacios.');
    valid = false;
    }

    if (correoRepresentante.value.trim() === '' || !validateEmail(correoRepresentante.value.trim())) {
        showError('errorCorreoRepresentante', 'Por favor, ingrese un correo válido.');
        valid = false;
    }
    if (passwordRepresentante.value.trim() === '') {
        showError('errorPasswordRepresentante', 'La contraseña del representante es obligatoria.');
        valid = false;
    }
    if (telefonoRepresentante.value.trim() === '' || !/^\d{10}$/.test(telefonoRepresentante.value)) {
    showError('errorTelefonoRepresentante', 'El teléfono es obligatorio y debe tener exactamente 10 dígitos.');
    valid = false;
    }


    // Si todos los campos son válidos, enviar el formulario
    if (valid) {
        event.target.submit();
    }
});

function showError(id, message) {
    var element = document.getElementById(id);
    element.textContent = message;
}

function clearErrors() {
    var errors = document.querySelectorAll('.error');
    errors.forEach(function(error) {
        error.textContent = '';
    });
}

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function validatePhone(phone) {
    var re = /^\d{10}$/;
    return re.test(phone);
}
</script>
