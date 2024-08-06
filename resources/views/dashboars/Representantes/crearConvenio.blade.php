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
                <h1>Solicitud de Convenio</h1>
                <form action="{{ route('convenios.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label>Escoge una Institución</label>
                    <select class="form-control" id="idInstitucion" name="idInstitucion" required>
                        @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id_empresa }}">{{ $empresa->nombreEmpresa }}</option>
                        @endforeach
                    </select>

                    <label>Crea tu contrato de Vinculación</label>
                    <textarea class="tinymce form-control" name="content" rows="10"></textarea>

                    <label>Sube un documento PDF (opcional)</label>
                    <input type="file" name="documento_pdf" class="form-control">

                    <button type="submit" class="btn btn-primary">Generar PDF</button>
                </form>
                @include('share1.footer')
            </div>
            @include('share1.btn-config')
        </div>
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- TinyMCE Initialization -->
    <script>
        tinymce.init({
            selector: 'textarea.tinymce'
        });
    </script>
</body>

</html>