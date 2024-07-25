@include ('share3.head')
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
        @include ('share3.nav')
        <div class="content">
            @include ('share3.nav_profile')
            <h1>Usuarios</h1>
            <div class="table-responsive">
                
            </div>
            @include ('share3.footer')
        </div>
        @include ('share3.btn-config')
    </div>
</main>
