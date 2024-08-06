@include ('share1.head')
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
        @include ('share1.nav')
        <div class="content">
            @include ('share1.nav_profile')
            <h1>Usuarios</h1>
            <a href="{{route('ruta.prueba2')}}">Ir a vista 2</a>
            @include ('share1.footer')
        </div>
        @include ('share1.btn-config')
    </div>
</main>