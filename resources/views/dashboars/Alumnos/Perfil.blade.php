@include('share3.head')

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
        @include('share3.nav')
        <div class="content">
            @include('share3.nav_profile')
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3 btn-reveal-trigger">
                        <div class="card-header position-relative min-vh-25 mb-8">
                            <div class="cover-image">
                                <div class="bg-holder rounded-3 rounded-bottom-0" style="background-image:url('data:image/jpeg;base64,{{ base64_encode($coverImageResponse) }}');"></div>

                            </div>
                            <div class="avatar avatar-5xl avatar-profile shadow-sm img-thumbnail rounded-circle">
                                <div class="h-100 w-100 rounded-circle overflow-hidden position-relative">
                                    <img src="data:image/jpeg;base64,{{ base64_encode($imageResponse) }}" width="200" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-0">
                <div class="card mb-3 btn-reveal-trigger">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="mb-0">{{ $user->nombreUsuario . " " . $user->apellidoPaterno . " " . $user->apellidoMaterno }}</h5>
                        </div>
                        <div class="card-body bg-light">
                            @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form class="row g-3" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="col-lg-6">
                                    <label class="form-label" for="email1">Email</label>
                                    <input class="form-control" id="email1" name="email" type="email" value="{{ old('email', $user->correoUsuario) }}" required />
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label class="form-label" for="phone">Teléfono</label>
                                    <input class="form-control" id="phone" name="telefono" type="text" value="{{ old('telefono', $user->telefonoUsuario) }}" required />
                                    @error('telefono')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-12">
                                    <label class="form-label" for="intro">Introducción</label>
                                    <textarea class="form-control" id="intro" name="descripcion" cols="30" rows="13">{{ old('descripcion', $user->descripcion) }}</textarea>
                                    @error('descripcion')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-12">
                                    <label class="form-label" for="profile_image">Foto de perfil</label>
                                    <input class="form-control" id="profile_image" name="profile_image" type="file" />
                                    @error('profile_image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-12">
                                    <label class="form-label" for="cover_image">Foto de portada</label>
                                    <input class="form-control" id="cover_image" name="cover_image" type="file" />
                                    @error('cover_image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-12">
                                    <label class="form-label" for="curriculum">Currículum</label>
                                    <input class="form-control" id="curriculum" name="curriculum" type="file" />
                                    @error('curriculum')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button class="btn btn-primary" type="submit">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Sección para mostrar el currículum -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="mb-0">Currículum</h5>
                        </div>
                        <div class="card-body bg-light">
                            @if($curriculumResponse)
                            <iframe src="data:application/pdf;base64,{{ base64_encode($curriculumResponse) }}" width="100%" height="600px"></iframe>
                            @else
                            <p>No hay currículum disponible.</p>
                            @endif
                        </div>
                    </div>
                    <!-- Aquí se pueden agregar más secciones de experiencia y educación -->
                </div>
            </div>
            @include('share3.footer')
        </div>
        @include('share3.btn-config')
    </div>
</main>