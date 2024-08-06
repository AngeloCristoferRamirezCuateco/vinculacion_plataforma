<!DOCTYPE html>
<html lang="en">
<head>
    @include('share.head')
    <style>
        .error-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container error-container">
        <div>
            <h1 class="display-1">Error de Conexión a la Base de Datos</h1>
            <p class="lead">Lo sentimos, no podemos conectar con la base de datos en este momento. Por favor, intenta nuevamente más tarde.</p>
            <a href="{{ url('/') }}" class="btn btn-primary">Volver al Inicio</a>
        </div>
    </div>
    @include('share.footer')
</body>
</html>
