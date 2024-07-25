@include ('share2.head')
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
        @include ('share2.nav')
        <div class="content">
            @include ('share2.nav_profile')
            <h1>Usuarios</h1>
            <div class="table-responsive">
                
            </div>

            @include ('share2.footer')
        </div>
        @include ('share2.btn-config')
    </div>
</main>
