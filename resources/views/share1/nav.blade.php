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
                    
                    <a class="nav-link" href="{{route('representante.panelConvenio')}}">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-users "></span></span><span class="nav-link-text ps-1">Solicitar Convenio</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{route('convenios.SolicitudesEnviadas')}}">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-users "></span></span><span class="nav-link-text ps-1">Solicitudes enviadas</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{route('convenios.index')}}">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-users "></span></span><span class="nav-link-text ps-1">Solicitudes recibidas</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{route('vacantes.solicitudes')}}">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-users "></span></span><span class="nav-link-text ps-1">Solicitudes Usuarios</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('representante.gestion') }}">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-users "></span></span><span class="nav-link-text ps-1">Convenios</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{route('proyect.create')}}">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-users "></span></span><span class="nav-link-text ps-1">Crear Proyecto</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{route('representante.panelVacante')}}">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-users "></span></span><span class="nav-link-text ps-1">Crear Vacante</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{route('lista.vacantes')}}">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-users "></span></span><span class="nav-link-text ps-1">Lista vacantes</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('proyectos.lista') }}" role="button">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-comments"></span></span><span class="nav-link-text ps-1">Proyectos</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{route('representante.panelInicio')}}" role="button">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-file-alt "></span></span><span class="nav-link-text ps-1">Registrar Usuarios</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{route('representante.asignar-docente')}}">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-users "></span></span><span class="nav-link-text ps-1">Asignar Docente</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{route('representante.panelDocentes')}}" role="button">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-address-card "></span></span><span class="nav-link-text ps-1">Docentes</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{route('representante.panelAlumnos')}}" role="button">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-address-card "></span></span><span class="nav-link-text ps-1">Alumnos</span>
                        </div>
                    </a>
     
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">

                        <div class="col-auto navbar-vertical-label"><span class="nav-link-icon"><span class="bi-gear-fill"></span></span><span class="nav-link-text ps-1">Configuración</span></div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider" />
                        </div>
                    </div>

                    <a class="nav-link" href="{{route('representante.perfil')}}" role="button">
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