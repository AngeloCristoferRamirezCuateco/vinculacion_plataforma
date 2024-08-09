<!DOCTYPE html>
<html lang="en">

<head>
    @include('share1.head')
</head>

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

                @if ($solicitudes->isEmpty())
                <h1 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">SIN SOLICITUDES</h1>
                @else
                <h1 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">SOLICITUDES RECIBIDAS</h1>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Empresa</th>
                                <th>Documento</th>
                                <th>Tipo de Solicitud</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="documentTableBody">

                            @foreach($solicitudes as $solicitud)
                            <tr>
                                <td>{{ $solicitud->emisor->empresa->nombreEmpresa }}</td>
                                <td>
                                    @if($solicitud->documento_pdf)
                                    <a href="{{ asset('storage/' . $solicitud->documento_pdf) }}" target="_blank">{{ $solicitud->documento_pdf }}</a>
                                    @else
                                    N/A
                                    @endif
                                </td>
                                <td>{{ $solicitud->tipoSolicitud }}</td>
                                <td>
                                    <form action="{{route('solicitudes.aceptar', ['id'=>$solicitud->id_solicitud])}}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Aceptar</button>
                                    </form>
                                    <form action="{{route('solicitudes.rechazar',['id'=>$solicitud->id_solicitud])}}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">Rechazar</button>
                                    </form>
                                    <form action="{{route('convenios.banear',['id'=>$solicitud->id_solicitud])}}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>