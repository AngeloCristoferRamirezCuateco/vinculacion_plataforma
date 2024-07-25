
 <nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
     <script>
         var navbarStyle = localStorage.getItem("navbarStyle");
         if (navbarStyle && navbarStyle !== 'transparent') {
             document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
         }
     </script>
     <div class="d-flex align-items-center">
         <div class="toggle-icon-wrapper">

             <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>

         </div><a class="navbar-brand" href="./management.php">
             <div class="d-flex align-items-center py-3"><img class="me-2" src="../assets/img/icons/spot-illustrations/falcon.png" alt="" width="40" /><span class="font-sans-serif text-primary">falcon</span>
             </div>
         </a>
     </div>
     <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
         <div class="navbar-vertical-content scrollbar">
             <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                 <li class="nav-item">
                     <a class="nav-link dropdown-indicator" href="#dashboard" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="dashboard">
                         <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span class="nav-link-text ps-1">Dashboard</span>
                         </div>
                     </a>
                     <ul class="nav collapse show" id="dashboard">
                         <li class="nav-item"><a class="nav-link active" href="../dashboard/management.php">
                                 <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Management</span>
                                 </div>
                             </a>

                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                         <div class="col-auto navbar-vertical-label">Panel de control
                         </div>
                         <div class="col ps-0">
                             <hr class="mb-0 navbar-vertical-divider" />
                         </div>
                     </div>
                     <a class="nav-link" href="../app/tables_user.php" role="button">
                         <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-users "></span></span><span class="nav-link-text ps-1">Gestionar Usuarios</span>
                         </div>
                     </a>
                     <a class="nav-link" href="#" role="button">
                         <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-users "></span></span><span class="nav-link-text ps-1">Registrar Empresa</span>
                         </div>
                     </a>
                     <a class="nav-link" href="../app/chat.php" role="button">
                         <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-comments"></span></span><span class="nav-link-text ps-1">Chat</span>
                         </div>
                     </a>
                 </li>
             </ul>
         </div>
     </div>
 </nav>