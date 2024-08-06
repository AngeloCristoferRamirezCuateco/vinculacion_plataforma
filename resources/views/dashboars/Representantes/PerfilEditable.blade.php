@include('share1.head')

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

        @include('share1.nav') 

        <div class="content"> 
            @include('share1.nav_profile') 

            <div class="row"> 
    <div class="col-12"> 
        <div class="card mb-3 btn-reveal-trigger"> 
            <div class="card-header position-relative min-vh-25 mb-8"> 
                <div class="cover-image"> 
                    <div class="bg-holder rounded-3 rounded-bottom-0" style="background-image:url('../../assets/img/generic/4.jpg');"></div> 
                    <input class="d-none" id="upload-cover-image" type="file" /> 
                    <label class="cover-image-file-input" for="upload-cover-image">
                        <span class="fas fa-camera me-2"></span><span>Change cover photo</span>
                    </label> 
                </div> 

                <div class="avatar avatar-5xl avatar-profile shadow-sm img-thumbnail rounded-circle"> 
                    <div class="h-100 w-100 rounded-circle overflow-hidden position-relative"> 
                        <img src="" width="200" alt="" data-dz-thumbnail="data-dz-thumbnail" /> 
                        <input class="d-none" id="profile-image" type="file" /> 
                        <label class="mb-0 overlay-icon d-flex flex-center" for="profile-image">
                            <span class="bg-holder overlay overlay-0"></span>
                            <span class="z-index-1 text-white dark__text-white text-center fs--1">
                                <span class="fas fa-camera"></span><span class="d-block">Update</span>
                            </span>
                        </label> 
                    </div> 
                </div> 

                <!-- Buttons positioned within the card-header -->
                <div class="position-absolute bottom-0 end-0 p-3">
                    <a class="btn btn-secondary" href="#">Cancelar</a>
                    
                </div>
            </div> 
        </div> 
    </div> 
</div>



            <div class="row"> 
                <div class="col-12"> 
                    <div class="card mb-3 btn-reveal-trigger"> 
                        <div class="card-header"> 
                            <h5 class="mb-0">Presentación</h5> 
                        </div> 
                        <div class="card-body bg-light"> 
                            <form class="row g-3"> 
                                <div class="col-lg-12"> 

                                    <textarea class="form-control" id="intro" name="intro" cols="30" rows="13">Dedicated</textarea> 
                                </div> 
                                <div class="col-12 d-flex justify-content-end"> 
                                    <button class="btn btn-primary" type="submit">Actualizar</button> 
                                </div> 
                            </form> 
                        </div> 
                    </div> 

                    <div class="card mb-3"> 
                        <div class="card-header"> 
                            <h5 class="mb-0">Experiencia</h5> 
                        </div> 
                        <div class="card-body bg-light">
                            <a class="mb-4 d-block d-flex align-items-center" href="#" data-bs-toggle="collapse" aria-expanded="false" aria-controls="experience-form1">
                                <span class="circle-dashed"><span class="fas fa-plus"></span></span>
                                <span class="ms-3">Agrega una experiencia </span>
                            </a> 
                            <div class="collapse" id="experience-form1"> 
                                <form class="row"> 
                                    <div class="col-3 mb-3 text-lg-end"> 
                                        <label class="form-label" for="company">Compania</label> 
                                    </div> 
                                    <div class="col-9 col-sm-7 mb-3"> 
                                        <input class="form-control form-control-sm" id="company" type="text" /> 
                                    </div> 
                                    <div class="col-3 mb-3 text-lg-end"> 
                                        <label class="form-label" for="position">Posicion</label> 
                                    </div> 
                                    <div class="col-9 col-sm-7 mb-3"> 
                                        <input class="form-control form-control-sm" id="position" type="text" /> 
                                    </div> 
                                    <div class="col-3 mb-3 text-lg-end"> 
                                        <label class="form-label" for="city">Ciudad</label> 
                                    </div> 
                                    <div class="col-9 col-sm-7 mb-3"> 
                                        <input class="form-control form-control-sm" id="city" type="text" /> 
                                    </div> 
                                    <div class="col-3 mb-3 text-lg-end"> 
                                        <label class="form-label" for="exp-description">Descripcion</label> 
                                    </div> 
                                    <div class="col-9 col-sm-7 mb-3"> 
                                        <textarea class="form-control form-control-sm" id="exp-description" rows="3"></textarea> 
                                    </div> 
                                    <div class="col-9 col-sm-7 offset-3 mb-3"> 
                                        <div class="form-check mb-0 lh-1"> 
                                            <input class="form-check-input" type="checkbox" id="experience-current" checked="checked" /> 
                                            <label class="form-check-label mb-0" for="experience-current">I currently work here</label> 
                                        </div> 
                                    </div> 
                                    <div class="col-3 text-lg-end"> 
                                        <label class="form-label" for="experience-form2">From</label> 
                                    </div> 
                                    <div class="col-9 col-sm-7 mb-3"> 
                                        <input class="form-control form-control-sm text-500 datetimepicker" id="experience-form2" type="text" placeholder="d/m/y" data-options='{"dateFormat":"d/m/y","disableMobile":true}' /> 
                                    </div> 
                                    <div class="col-3 text-lg-end"> 
                                        <label class="form-label" for="experience-to">To</label> 
                                    </div> 
                                    <div class="col-9 col-sm-7 mb-3"> 
                                        <input class="form-control form-control-sm text-500 datetimepicker" id="experience-to" type="text" placeholder="d/m/y" data-options='{"dateFormat":"d/m/y","disableMobile":true}' /> 
                                    </div> 
                                    <div class="col-9 col-sm-7 offset-3"> 
                                        <button class="btn btn-primary" type="button">Guardar</button> 
                                    </div> 
                                </form> 
                                <div class="border-dashed-bottom my-4"></div> 
                            </div> 
                        </div> 
                    </div> 


                </div> 
            </div> 

        @include('share1.footer') 
        @include('share1.btn-config') 
    </div> 
</main>