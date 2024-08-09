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
                <h1 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">SOLICITUD DE CONVENIO</h1>
                <form class="row g-3" action="{{ route('convenios.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12 text-center mb-3">
                    <label class="form-label fw-bold fs-7">Escoge una Institución</label>
                    <select class="form-control border-primary" style="border-radius: 50px;" id="idInstitucion" name="idInstitucion" required>
                        @foreach ($empresas as $empresa)
                        @if ($empresa->id_empresa !== $user->id_empresa)
                        <option value="{{ $empresa->id_empresa }}">{{ $empresa->nombreEmpresa }}</option>
                        @endif
                        @endforeach
                    </select>
                    </div>

                    <label class="form-label fw-bold fs-8">Crea tu contrato de Vinculación</label>
                    <textarea class="tinymce form-control" name="content" id="form-content" rows="10"></textarea>
                    <div class="col-12 d-flex justify-content-between">
                    <div class="col-md-7">
                    
                    <input type="file" name="documento_pdf" class="form-control">
                    <label class="form-label fw-bold fs-8">Sube un documento PDF (opcional)</label>
                    </div>
                    
                </form>
                
                <!-- Formulario para generar PDF -->
                 <div class="col-md-2">
                <form action="{{ route('generate.pdf') }}" method="POST">
                    @csrf
                    <input type="hidden" id="pdf_idInstitucion" name="idInstitucion">
                    <input type="hidden" id="pdf_content" name="content">
                    <button type="submit" class="btn btn-primary" onclick="setPdfData(event)">Generar PDF</button>
                </form>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
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
    <script>
        tinymce.init({
            selector: 'textarea.tinymce'
        });

        function setPdfData(event) {
            event.preventDefault();

            document.getElementById('pdf_idInstitucion').value = document.getElementById('idInstitucion').value;
            document.getElementById('pdf_content').value = tinymce.get('form-content').getContent();

            event.target.form.submit();
        }
    </script>
</body>
</html>
