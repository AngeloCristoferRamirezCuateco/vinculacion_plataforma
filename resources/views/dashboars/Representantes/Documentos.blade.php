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
                <h1>Documentos Recibidos</h1>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Empresa</th>
                                <th>Documento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="documentTableBody">
                            
                        </tbody>
                    </table>
                </div>
                <!-- Modal para vista previa del documento -->
                <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="previewModalLabel">Vista Previa del Documento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="previewModalBody">
                                <!-- Contenido del documento -->
                            </div>
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

    // Ejemplo de datos de documentos recibidos
    const documents = [
        { empresa: 'BUAP', documento: 'Contrato BUAP', contenido: '<p>Contenido del contrato BUAP...</p>' },
        { empresa: 'UTP', documento: 'Contrato UTP', contenido: '<p>Contenido del contrato UTP...</p>' },
        { empresa: 'ITP', documento: 'Contrato ITP', contenido: '<p>Contenido del contrato ITP...</p>' },
        { empresa: 'UVP', documento: 'Contrato UVP', contenido: '<p>Contenido del contrato UVP...</p>' }
    ];

    const documentTableBody = document.getElementById('documentTableBody');

    // Función para cargar los documentos en la tabla
    function loadDocuments() {
        documents.forEach((doc, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${doc.empresa}</td>
                <td>${doc.documento}</td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="previewDocument(${index})">Vista Previa</button>
                    <button class="btn btn-success btn-sm" onclick="acceptDocument(${index})">Aceptar</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteDocument(${index})">Eliminar</button>
                </td>
            `;
            documentTableBody.appendChild(row);
        });
    }

    // Función para mostrar la vista previa del documento
    function previewDocument(index) {
        const previewModalBody = document.getElementById('previewModalBody');
        previewModalBody.innerHTML = documents[index].contenido;
        const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
        previewModal.show();
    }

    // Función para aceptar el documento (ejemplo)
    function acceptDocument(index) {
        alert('Documento aceptado: ' + documents[index].documento);
    }

    // Función para eliminar el documento
    function deleteDocument(index) {
        documents.splice(index, 1);
        documentTableBody.innerHTML = '';
        loadDocuments();
    }

    // Cargar los documentos al cargar la página
    document.addEventListener('DOMContentLoaded', loadDocuments);
</script>
</body>
</html>