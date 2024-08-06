@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Convenios en Gestión</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Emisor</th>
                    <th>Receptor</th>
                    <th>Estado</th>
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
                        <td>
                            <a href="{{ route('convenios.show', $convenio->id_convenio) }}" class="btn btn-info">Ver Detalles</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
