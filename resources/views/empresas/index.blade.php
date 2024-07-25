<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ingresar</title>
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicons/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">
  <link rel="manifest" href="{{ asset('assets/img/favicons/manifest.json') }}">
  <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicons/mstile-150x150.png') }}">
  <meta name="theme-color" content="#ffffff">
  <script src="{{ asset('assets/js/config.js') }}"></script>
  <script src="{{ asset('vendors/simplebar/simplebar.min.js') }}"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
  <link href="{{ asset('vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
  @vite(['resources/scss/theme.scss', 'resources/scss/user.scss', 'resources/js/app.js'])
  <script>
    var isRTL = JSON.parse(localStorage.getItem('isRTL'));
    if (isRTL) {
      var linkDefault = document.getElementById('style-default');
      var userLinkDefault = document.getElementById('user-style-default');
      linkDefault.setAttribute('disabled', true);
      userLinkDefault.setAttribute('disabled', true);
      document.querySelector('html').setAttribute('dir', 'rtl');
    } else {
      var linkRTL = document.getElementById('style-rtl');
      var userLinkRTL = document.getElementById('user-style-rtl');
      linkRTL.setAttribute('disabled', true);
      userLinkRTL.setAttribute('disabled', true);
    }
  </script>
</head>

<body>
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
      <div class="row flex-center min-vh-100 py-6">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4"><a class="d-flex flex-center mb-4"><img class="me-2" src="{{ asset('assets/img/icons/spot-illustrations/falcon.png') }}" alt="" width="58" /><span class="font-sans-serif text-primary fw-bolder fs-4 d-inline-block">PVU</span></a>
          <div class="card">
            <div class="card-body p-4 p-sm-5">
              <div class="row flex-between-center mb-2">
                <div class="col-auto">
                  <h5>Log in</h5>
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
                  <input class="form-control" type="email" name="email" placeholder="Email address" required />
                </div>
                <div class="mb-3">
                  <input class="form-control" type="password" name="password" placeholder="Password" required />
                </div>
                <div class="row flex-between-center">
                  <div class="col-auto">
                  </div>
                  <div class="col-auto"><a class="fs-10" href="#">Forgot Password?</a></div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Log in</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="{{ asset('vendors/popper/popper.min.js') }}"></script>
  <script src="{{ asset('vendors/bootstrap/bootstrap.min.js') }}"></script>
  <script src="{{ asset('vendors/anchorjs/anchor.min.js') }}"></script>
  <script src="{{ asset('vendors/is/is.min.js') }}"></script>
  <script src="{{ asset('vendors/fontawesome/all.min.js') }}"></script>
  <script src="{{ asset('vendors/lodash/lodash.min.js') }}"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
  <script src="{{ asset('vendors/list.js/list.min.js') }}"></script>
  <script src="{{ asset('assets/js/theme.js') }}"></script>

</body>

</html>
