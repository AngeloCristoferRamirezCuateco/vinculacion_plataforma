@include('share1.head')

<main class="main" id="top">
    <div class="container" data-layout="container">
        @include('share1.nav')
        <div class="content">
            @include('share1.nav_profile')
            <div class="container mt-4 p-4" style="background-color: #fff; border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h1 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">PROYECTOS</h1>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Nombre de Proyecto</th>
                            <th scope="col">Metas</th>
                            <th scope="col">Alcance</th>
                            <th scope="col">Proposito</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($proyectos)
                            @foreach ($proyectos as $proyecto)
                                <tr id="user-row-{{ $proyecto->id_proyecto }}">
                                    <td>{{ $proyecto->nombre_proyecto }}</td>
                                    <td>{{ $proyecto->metas }}</td>
                                    <td>{{ $proyecto->alcance }}</td>
                                    <td>{{ $proyecto->proposito }}</td>
                                    <td>
                                        <form action="{{ route('proyecto.destroy', $proyecto->id_proyecto) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            </div>
            @include('share1.footer')
        </div>
        @include('share1.btn-config')
    </div>
</main>
