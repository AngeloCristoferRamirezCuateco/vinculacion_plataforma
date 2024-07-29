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
                <h1>Trato de vinculación</h1>
                <div class="col-md-4">
                    <label>Escoge una Institucion</label>
                    <label class="form-label" for="idInstitucion"></label>
                    <select class="form-control" id="idInstitucion" name="idInstitucion" required>
                        <option value="BUAP">BUAP</option>
                        <option value="UTP">UTP</option>
                        <option value="ITP">ITP</option>
                        <option value="UVP">UVP</option>
                    </select>
                </div>
                </br>
                <label>Crea tu contrato de Vinculación</label>
                <div class="card mb-3">
                    <div class="row flex-between-end"></div>
                    <div class="card-body bg-light">
                        <div class="tab-content">
                            <div class="tab-pane preview-tab-pane active" role="tabpanel" aria-labelledby="tab-dom-703a1e05-114f-4fdd-8a90-aa02f91c853c" id="dom-703a1e05-114f-4fdd-8a90-aa02f91c853c">
                                <div class="min-vh-50">
                                    <textarea class="tinymce" name="content"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button id="previewButton" class="btn btn-primary">Vista Previa</button>
                <div id="previewContent" class="card mt-3 d-none">
                    <div class="card-header">Vista Previa del Documento</div>
                    <div class="card-body">
                        <div id="previewBody"></div>
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

    document.getElementById('previewButton').addEventListener('click', function() {
        var content = tinymce.get('content').getContent();
        var previewContent = document.getElementById('previewContent');
        var previewBody = document.getElementById('previewBody');
        previewBody.innerHTML = content;
        previewContent.classList.remove('d-none');
    });
</script>
</body>
</html>