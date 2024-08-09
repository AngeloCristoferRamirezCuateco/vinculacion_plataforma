@extends('layouts.app')

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
                <div class="container mt-4">
                    <div class="container mt-4 p-4" style="background-color: #fff; border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <h1 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">GESTIÓN DE CONVENIOS</h1>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Emisor</th>
                                <th>Receptor</th>
                                <th>Estado</th>
                                <th>Fecha de Creación</th>
                                <th>Fecha de Actualización</th>
                                <th>Descripción</th>
                                <th>Tipo de Convenio</th>
                                <th>Documentos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($convenios as $convenio)
                                <tr>
                                    <td>{{ $convenio->id_convenio }}</td>
                                    <td>{{ $convenio->emisor->nombreUsuario }}</td>
                                    <td>{{ $convenio->receptor->nombreUsuario }}</td>
                                    <td>{{ $convenio->estado }}</td>
                                    <td>{{ $convenio->created_at }}</td>
                                    <td>{{ $convenio->updated_at }}</td>
                                    <td>{{ $convenio->descripcion }}</td>
                                    <td>{{ $convenio->tipo }}</td>
                                    <td>
                                        @if($convenio->documentos)
                                            <a href="{{ route('convenios.documentos', $convenio->id_convenio) }}" class="btn btn-primary">Ver Documentos</a>
                                        @else
                                            No hay documentos
                                        @endif
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
