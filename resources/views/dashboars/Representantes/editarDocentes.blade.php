@include('share1.head')
@vite(['resources/scss/theme.scss', 'resources/scss/user.scss', 'resources/js/app.js'])

<main class="main" id="top">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('vendors/simplebar/simplebar.min.js') }}"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    
    <div class="container" data-layout="container">
        @include('share1.nav')
        <div class="content">
            @include('share1.nav_profile')
            <h1>Edición de docentes</h1>
            
            <form id="update-form" method="POST" action="{{ route('usuarios.update', $usuario->id_usuario) }}">
                @csrf
                @method('PUT')
                <h2>Editar Usuario</h2>
                <input type="hidden" name="id_usuario" id="form-id_usuario" value="{{ $usuario->id_usuario }}">
                <div class="col-md-4">
                    <label class="form-label" for="form-nombreUsuario">Nombre</label>
                    <input class="form-control" id="form-nombreUsuario" name="nombreUsuario" type="text" value="{{ old('nombreUsuario', $usuario->nombreUsuario) }}" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="form-apellidoPaterno">Apellido Paterno</label>
                    <input class="form-control" id="form-apellidoPaterno" name="apellidoPaterno" type="text" value="{{ old('apellidoPaterno', $usuario->apellidoPaterno) }}" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="form-apellidoMaterno">Apellido Materno</label>
                    <input class="form-control" id="form-apellidoMaterno" name="apellidoMaterno" type="text" value="{{ old('apellidoMaterno', $usuario->apellidoMaterno) }}" />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="form-correoUsuario">Email</label>
                    <input class="form-control" id="form-correoUsuario" name="correoUsuario" type="email" value="{{ old('correoUsuario', $usuario->correoUsuario) }}" required />
                </div>
                <div class="col-12 mt-3">
                    <button class="btn btn-secondary" type="button" onclick="window.history.back()">Volver</button>
                    <button class="btn btn-primary" type="submit">Actualizar</button>
                </div>
            </form>

            @include('share1.footer')
        </div>
        @include('share1.btn-config')
    </div>
    
    <script src="{{ asset('vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('vendors/lodash/lodash.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset('vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
</main>
