<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    <script>
        var navbarStyle = localStorage.getItem("navbarStyle");
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css" />
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">

            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>

        </div><a class="navbar-brand" href="#">
            <div class="d-flex align-items-center py-3"><img class="me-2" src="../assets/img/icons/spot-illustrations/falcon.png" alt="" width="40" /><span class="font-sans-serif text-primary">PVU</span>
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">

                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Panel de control
                        </div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider" />
                        </div>
                    </div>

                    <a class="nav-link" href="{{route('dashboard.index')}}" role="button">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-chart-line "></span></span><span class="nav-link-text ps-1">Estado actual de la plataforma</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{route('admin.panelregisterempresa')}}" role="button">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-pen-square "></span></span><span class="nav-link-text ps-1">Registrar Empresa</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{route('admin.panelregisteruser')}}" role="button">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-pen-square "></span></span><span class="nav-link-text ps-1">Registrar Usuarios</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{route('admin.paneleditUsers')}}" role="button">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-list-ul "></span></span><span class="nav-link-text ps-1">Listar Usuarios</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{route('admin.paneleditEmpresas')}}" role="button">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-list-ul "></span></span><span class="nav-link-text ps-1">Listar Empresas</span>
                        </div>
                    </a>
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Configuración
                        </div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider" />
                        </div>
                    </div>
                    <a class="nav-link" href="{{route('admin.perfil')}}" role="button">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="bi-person-fill "></span></span><span class="nav-link-text ps-1">Perfil</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{route('app.logout')}}" role="button">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="bi-box-arrow-left "></span></span><span class="nav-link-text ps-1">Cerrar Sesion</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>