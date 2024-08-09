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
                    <h1 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">CREAR VACANTE</h1>
                    <form class="row g-3" action="{{route('vacantes.store')}}" method="POST">
                    @csrf
                        <div class="col-md-6">
                            <label class="form-label fw-bold fs-8">Proyecto</label>
                            <select class="form-select border-primary" style="border-radius: 50px;" id="proyectoDisponible" name="proyectoDisponible" required>
                                @foreach($proyectos as $proyecto)
                                <option value="{{ $proyecto->id_proyecto }}">{{ $proyecto->nombre_proyecto }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold fs-8" for="#">Vacantes</label>
                            <input class="form-control border-primary" style="border-radius: 50px;" id="numeroVacantes" name="numeroVacantes" type="number" value="" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold fs-8" for="#">Datos de vacante</label>
                            <input class="form-control border-primary" style="border-radius: 50px;" id="datosVacante" name="datosVacante" type="text" value="" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold fs-8" for="#">Estado del Vacante</label>
                            <select class="form-control border-primary" style="border-radius: 50px;" id="estadoVacante" name="estadoVacante" required>
                                <option value="Activa">Activa</option>
                                <option value="Cerrada">Cerrada</option>
                            </select>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <button class="btn btn-primary w-50 py-2" style="border-radius: 50px;" type="submit">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
            @include('share1.footer')
        </div>
        @include('share1.btn-config')
        </div>
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- TinyMCE Initialization -->
</body>

</html>