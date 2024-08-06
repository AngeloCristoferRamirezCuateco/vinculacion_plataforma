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
                <h1>Proceso de Convenio</h1>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Convenio entre {{ $convenio->emisor->nombreUsuario }} y {{ $convenio->receptor->nombreUsuario }}</h5>
                        <p class="card-text">Sube los documentos necesarios para el convenio.</p>

                        @if($convenio->documento_emisor)
                            <p>Documento del emisor: <a href="{{ asset('storage/' . $convenio->documento_emisor) }}" target="_blank">Ver Documento</a></p>
                        @else
                            <form action="{{ route('convenios.upload', $convenio->id_convenio) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="documento" class="form-label">Subir Documento del Emisor</label>
                                    <input type="file" class="form-control" id="documento" name="documento">
                                </div>
                                <button type="submit" class="btn btn-primary">Subir</button>
                            </form>
                        @endif

                        @if($convenio->documento_receptor)
                            <p>Documento del receptor: <a href="{{ asset('storage/' . $convenio->documento_receptor) }}" target="_blank">Ver Documento</a></p>
                        @else
                            <form action="{{ route('convenios.upload', $convenio->id_convenio) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="documento" class="form-label">Subir Documento del Receptor</label>
                                    <input type="file" class="form-control" id="documento" name="documento">
                                </div>
                                <button type="submit" class="btn btn-primary">Subir</button>
                            </form>
                        @endif

                        @if($convenio->documento_emisor && $convenio->documento_receptor)
                            <form action="{{ route('convenios.finalize', $convenio->id_convenio) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success mt-3">Concretar Convenio</button>
                            </form>
                        @endif
                    </div>
                </div>
                @include('share1.footer')
            </div>
            @include('share1.btn-config')
        </div>
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
