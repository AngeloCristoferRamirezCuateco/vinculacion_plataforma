@include('share1.head')

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
                <h1 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">Actualizar Vacante</h1>
                <form action="{{ route('vacantes.update', $vacante->id_vacante) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="proyectoDisponible" class="form-label">Nombre del Proyecto</label>
                        <input type="text" class="form-control" id="proyectoDisponible" name="proyectoDisponible" value="{{ $vacante->proyectoDisponible }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="numeroVacantes" class="form-label">Número de Vacantes</label>
                        <input type="number" class="form-control" id="numeroVacantes" name="numeroVacantes" value="{{ $vacante->numeroVacantes }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="datosVacante" class="form-label">Descripción</label>
                        <textarea class="form-control" id="datosVacante" name="datosVacante" required>{{ $vacante->datosVacante }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="estadoVacante" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="estadoVacante" name="estadoVacante" value="{{ $vacante->estadoVacante }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ url()->previous() }}" class="btn btn-warning btn-sm">Volver</a>
                </form>
            </div>
        </div>
        @include('share1.footer')
        @include('share1.btn-config')
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
