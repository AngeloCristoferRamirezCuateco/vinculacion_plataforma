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
                    <h1 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">ASIGNACIÓN DE DOCENTE</h1>
                    <form class="row g-3" action="{{ route('representante.alumnodocente') }}" method="POST">
                        @csrf
                        <div class="col-md-6">
                            <label class="form-label fw-bold fs-8">Docentes</label>
                            <select class="form-select border-primary" style="border-radius: 50px;" id="docente" name="docente_id" required>
                                @foreach($docentes as $docente)
                                    <option value="{{ $docente->id_usuario }}">{{ $docente->nombreUsuario }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold fs-8">Alumno</label>
                            <div id="alumnos-container">
                                <div class="alumno-select">
                                <select class="form-select border-primary" style="border-radius: 50px;" id="alumno" name="alumnos_ids[]" required>
                                        @foreach($alumnos as $alumno)
                                            <option value="{{ $alumno->id_usuario }}">{{ $alumno->nombreUsuario }}</option>
                                        @endforeach
                                    </select>
                                </div><br>
                            </div>
                            <div class="col-md-6">
                            <button type="button" class="btn btn-outline-primary mt-3" id="add-alumno" style="border-radius: 50px;">
                                Agregar otro alumno
                            </button>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <button class="btn btn-primary w-50 py-2" style="border-radius: 50px;" type="submit" href="{{route('representante.alumnodocente')}}">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
            @include('share1.footer')
        </div>
        @include('share1.btn-config')
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('add-alumno').addEventListener('click', function() {
            // Clona el primer select de alumno
            var newAlumnoSelect = document.querySelector('.alumno-select').cloneNode(true);
            // Resetea el valor del select recién clonado
            newAlumnoSelect.querySelector('select').selectedIndex = 0;
            // Añade el nuevo select al contenedor
            document.getElementById('alumnos-container').appendChild(newAlumnoSelect);
        });
    </script>
</body>
</html>
