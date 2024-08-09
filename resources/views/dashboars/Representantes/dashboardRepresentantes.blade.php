@include('share1.head')

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
            @include('share1.nav')
            <div class="content">
                @include('share1.nav_profile')
                <div class="container mt-4 p-4" style="background-color: #fff; border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <form id="registroForm" class="row g-3 needs-validation" method="POST" action="{{ route('representante.registerRepresentante') }}" novalidate>
                        @csrf
                        @if (isset($user))
                            <h1 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">Registro de Usuarios, bienvenido {{ $user->nombreUsuario }}</h1>
                        @else
                            <h1 class="text-center mb-4" style="color: inherit;">Registro de Usuarios</h1>
                        @endif
                        <div class="col-md-4">
                            <label class="form-label fw-bold fs-8" for="nombreUsuario">Nombre</label>
                            <input class="form-control border-primary" style="border-radius: 50px;" id="nombreUsuario" name="nombreUsuario" type="text" required />
                            <span id="errorNombreUsuario" class="text-danger"></span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold fs-8" for="apellidoPaterno">Apellido Paterno</label>
                            <input class="form-control border-primary" style="border-radius: 50px;" id="apellidoPaterno" name="apellidoPaterno" type="text" required />
                            <span id="errorApellidoPaterno" class="text-danger"></span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold fs-8" for="apellidoMaterno">Apellido Materno</label>
                            <input class="form-control border-primary" style="border-radius: 50px;" id="apellidoMaterno" name="apellidoMaterno" type="text" />
                            <span id="errorApellidoMaterno" class="text-danger"></span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold fs-8" for="correoUsuario">Email</label>
                            <input class="form-control border-primary" style="border-radius: 50px;" id="correoUsuario" name="correoUsuario" type="email" required />
                            <span id="errorCorreoUsuario" class="text-danger"></span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold fs-8" for="passwordUsuario">Password</label>
                            <input class="form-control border-primary" style="border-radius: 50px;" id="passwordUsuario" name="passwordUsuario" type="password" required />
                            <span id="errorPasswordUsuario" class="text-danger"></span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold fs-8" for="id_rol">Rol del Usuario</label>
                            <select class="form-control border-primary" style="border-radius: 50px;" id="id_rol" name="id_rol" required>
                                @foreach ($Rol as $roles)
                                    @if ($roles->id_rol === 1 || $roles->id_rol === 2)
                                        <option value="{{ $roles->id_rol }}">{{ $roles->nombreRol }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 offset-md-4">
                            <label class="form-label fw-bold fs-8" for="telefonoUsuario">Teléfono</label>
                            <input class="form-control border-primary" style="border-radius: 50px;" id="telefonoUsuario" name="telefonoUsuario" type="tel" required />
                            <span id="errorTelefonoUsuario" class="text-danger"></span>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <button class="btn btn-primary w-50 py-2" style="border-radius: 50px;" type="submit">Enviar</button>
                        </div>
                    </form>
                </div>
                @include('share1.footer')
                @include('share1.btn-config')
            </div>
        </div>
    </main>
    <script>
        document.getElementById('registroForm').addEventListener('submit', function(event) {
            var isValid = true;

            // Validación para los nombres
            var nombreUsuario = document.getElementById('nombreUsuario');
            if (nombreUsuario.value.trim() === '' || !/^[a-zA-Z\s]+$/.test(nombreUsuario.value)) {
                showError('errorNombreUsuario', 'El nombre es obligatorio y solo puede contener letras y espacios.');
                isValid = false;
            } else {
                clearError('errorNombreUsuario');
            }

            // Validación para los apellidos
            var apellidoPaterno = document.getElementById('apellidoPaterno');
            if (apellidoPaterno.value.trim() === '' || !/^[a-zA-Z\s]+$/.test(apellidoPaterno.value)) {
                showError('errorApellidoPaterno', 'El apellido paterno es obligatorio y solo puede contener letras y espacios.');
                isValid = false;
            } else {
                clearError('errorApellidoPaterno');
            }

            var apellidoMaterno = document.getElementById('apellidoMaterno');
            if (apellidoMaterno.value.trim() !== '' && !/^[a-zA-Z\s]+$/.test(apellidoMaterno.value)) {
                showError('errorApellidoMaterno', 'El apellido materno solo puede contener letras y espacios.');
                isValid = false;
            } else {
                clearError('errorApellidoMaterno');
            }

            // Validación para el correo electrónico
            var correoUsuario = document.getElementById('correoUsuario');
            if (correoUsuario.value.trim() === '') {
                showError('errorCorreoUsuario', 'El correo electrónico es obligatorio.');
                isValid = false;
            } else if (!/^\S+@\S+\.\S+$/.test(correoUsuario.value)) {
                showError('errorCorreoUsuario', 'Por favor, ingrese un correo electrónico válido.');
                isValid = false;
            } else {
                clearError('errorCorreoUsuario');
            }

            // Validación para la contraseña
            var passwordUsuario = document.getElementById('passwordUsuario');
            if (passwordUsuario.value.trim() === '') {
                showError('errorPasswordUsuario', 'La contraseña es obligatoria.');
                isValid = false;
            } else if (passwordUsuario.value.length < 8) {
                showError('errorPasswordUsuario', 'La contraseña debe tener al menos 8 caracteres.');
                isValid = false;
            } else {
                clearError('errorPasswordUsuario');
            }

            // Validación para el teléfono
            var telefonoUsuario = document.getElementById('telefonoUsuario');
            if (telefonoUsuario.value.trim() === '' || !/^\d{10}$/.test(telefonoUsuario.value)) {
                showError('errorTelefonoUsuario', 'El teléfono es obligatorio y debe tener exactamente 10 dígitos.');
                isValid = false;
            } else {
                clearError('errorTelefonoUsuario');
            }

            if (!isValid) {
                event.preventDefault();
            }
        });

        function showError(elementId, message) {
            document.getElementById(elementId).textContent = message;
        }

        function clearError(elementId) {
            document.getElementById(elementId).textContent = '';
        }
    </script>
</body>
