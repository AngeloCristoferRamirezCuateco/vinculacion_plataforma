@include('share4.head')
@vite(['resources/scss/theme.scss', 'resources/scss/user.scss', 'resources/js/app.js'])

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
        <div class="row justify-content-center align-items-center min-vh-100" style="border-radius: 30px;">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                <a class="d-flex justify-content-center mb-4">
                    <img class="me-2" src="{{ asset('assets/img/icons/spot-illustrations/falcon.png') }}" alt="" width="58" />
                    <span class="font-sans-serif text-primary fw-bolder fs-4 d-inline-block">PVU</span>
                </a>
                <div class="card">
                    <div class="card-body p-4 p-sm-5">
                        <div class="row flex-between-center mb-2">
                            <div class="col-auto">
                                <h5>Ingresar</h5>
                            </div>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <input  class="form-control" style="border-radius: 50px;" type="email" name="email" placeholder="Correo electroónico" required />
                            </div>
                            <div class="mb-3">
                                <input class="form-control" style="border-radius: 50px;" type="password" name="password" placeholder="Contraseña" required />
                            </div>
                           
                            <div class="mb-3">
                                <button class="btn btn-primary d-block w-100 mt-3" style="border-radius: 50px;" type="submit" name="submit">Iniciar Sesión</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('share4.footer')
    </div>
</main>
