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
    
          <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                
                <div class="col-lg-6">
                  <h5>titulo de proyecto</h5><a class="fs--1 mb-2 d-block" href="#!">Nombre de Empresa</a>
                  </div>
                  <p class="fs--1">Testing conducted by Apple in October 2018 using pre-production 2.9GHz 6‑core Intel Core i9‑based 15-inch MacBook Pro systems with Radeon Pro Vega 20 graphics, and shipping 2.9GHz 6‑core Intel Core i9‑based 15‑inch MacBook Pro systems with Radeon Pro 560X graphics, both configured with 32GB of RAM and 4TB SSD.</p>
            
                  <div class="row">
                  
                    <div class="col-auto px-2 px-md-3"><a class="btn btn-sm btn-primary" href="#!"><span class="fas fa-cart-plus me-sm-2"></span><span class="d-none d-sm-inline-block">Inscribirme</span></a></div>
                    <div class="col-auto px-0"><a class="btn btn-sm btn-outline-danger border-300" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wish List"><span class="far fa-heart me-1"></span>282</a></div>
                  </div>
                </div>
              </div>
            
            </div>


            @include ('share3.footer')

        @include ('share3.btn-config')

        
