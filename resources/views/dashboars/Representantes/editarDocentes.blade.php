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
            <div class="container mt-4 p-4" style="background-color: #fff; border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h1 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">EDITAR DOCENTE</h1>
            <form class="row g-3 needs-validation" id="update-form" method="POST" action="{{ route('usuarios.update', $usuario->id_usuario) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_usuario" id="form-id_usuario" value="{{ $usuario->id_usuario }}">
                <div class="col-md-6">
                    <label class="form-label fw-bold fs-8" for="form-nombreUsuario">Nombre</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="form-nombreUsuario" name="nombreUsuario" type="text" value="{{ old('nombreUsuario', $usuario->nombreUsuario) }}" required />
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold fs-8" for="form-apellidoPaterno">Apellido Paterno</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="form-apellidoPaterno" name="apellidoPaterno" type="text" value="{{ old('apellidoPaterno', $usuario->apellidoPaterno) }}" required />
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold fs-8" for="form-apellidoMaterno">Apellido Materno</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="form-apellidoMaterno" name="apellidoMaterno" type="text" value="{{ old('apellidoMaterno', $usuario->apellidoMaterno) }}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold fs-8" for="form-correoUsuario">Email</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="form-correoUsuario" name="correoUsuario" type="email" value="{{ old('correoUsuario', $usuario->correoUsuario) }}" required />
                </div>
                <div class="col-6">
                    <button class="btn btn-primary col-md-12" style="border-radius: 50px;" type="button" onclick="window.history.back()">Volver</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-success col-md-12" style="border-radius: 50px;" type="submit">Actualizar</button>
                </div>
            </form>
            </div>
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
