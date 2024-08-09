@include ('share.head')
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
        <script>
            var isFluid = JSON.parse(localStorage.getItem('isFluid'));
            if (isFluid) {
                var container = document.querySelector('[data-layout]');
                container.classList.remove('container');
                container.classList.add('container-fluid');
            }
        </script>
        @include ('share.nav')
        <div class="content">
            @include ('share.nav_profile')
            <div class="container mt-4 p-4" style="background-color: #fff; border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">

            <form class="row g-3 needs-validation" novalidate="" method="POST" action="{{ route('empresas.update', $empresas->id_empresa) }}">
                @csrf
                @method('PUT')
                <h1 class="text-center mb-3 fw-bold fs-4" style="color: inherit;">EDITAR EMPRESA</h1>
                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="nombreEmpresa">Nombre de la Empresa</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="nombreEmpresa" name="nombreEmpresa" type="text" value="{{ $empresas->nombreEmpresa }}" required="" />
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="tipoEmpresa">Tipo de Empresa</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="tipoEmpresa" name="tipoEmpresa" type="text" value="{{ $empresas->tipoEmpresa }}" required="" />
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="areaEmpresa">Área de la Empresa</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="areaEmpresa" name="areaEmpresa" type="text" value="{{ $empresas->areaEmpresa }}" required="" />
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="direccionEmpresa">Dirección</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="direccionEmpresa" name="direccionEmpresa" type="text" value="{{ $empresas->direccionEmpresa }}" required="" />
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="correoEmpresa">Correo</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="correoEmpresa" name="correoEmpresa" type="email" value="{{ $empresas->correoEmpresa }}" aria-describedby="inputGroupPrepend" required="" />
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold fs-8" for="rfcEmpresa">RFC</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="rfcEmpresa" name="rfcEmpresa" type="text" value="{{ $empresas->rfcEmpresa }}" required="" />
                </div>
                <div class="col-md-4 offset-md-4">
                    <label class="form-label fw-bold fs-8" for="evaluacionEmpresa">Calificación</label>
                    <input class="form-control border-primary" style="border-radius: 50px;" id="evaluacionEmpresa" name="evaluacionEmpresa" type="text" value="{{ $empresas->evaluacionEmpresa }}" required="" />
                </div>
                <div class="col-6">
                    <button class="btn btn-primary col-md-12" style="border-radius: 50px;" onclick="window.location.href='{{redirect()->back()}}'">Volver</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-success col-md-12" style="border-radius: 50px;" type="submit">Actualizar</button>
                </div>
            </form>
            </div>
            @include ('share.footer')
            @include ('share.btn-config')
        </div>
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
