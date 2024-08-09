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
                <div class="container mt-4 p-4" style="max-width: 600px; background-color: #fff; border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <h1 class="text-center mb-4 fw-bold fs-4" style="color: inherit;">CREAR PROYECTO</h1>
                    <form class="row g-3 needs-validation" method="POST" action="{{ route('proyecto.create') }}">
                        @csrf
                        <div class="col-12">
                            <label class="form-label fw-bold fs-8" for="nombre_proyecto">Nombre de Proyecto</label>
                            <input class="form-control border-primary" style="border-radius: 50px;" id="nombre_proyecto" name="nombre_proyecto" type="text" required />
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold fs-8" for="metas">Metas</label>
                            <input class="form-control border-primary" style="border-radius: 50px;" id="metas" name="metas" type="text" required />
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold fs-8" for="alcance">Alcance</label>
                            <input class="form-control border-primary" style="border-radius: 50px;" id="alcance" name="alcance" type="text" required />
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold fs-8" for="proposito">Propósito</label>
                            <input class="form-control border-primary" style="border-radius: 50px;" id="proposito" name="proposito" type="text" required />
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <button class="btn btn-primary w-50 py-2" style="border-radius: 50px;" type="submit">Crear</button>
                        </div>
                    </form>
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
