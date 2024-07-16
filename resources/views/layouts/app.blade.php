<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Incluir CSS compilado de SCSS con Vite -->
    @vite(['resources/scss/theme.scss', 'resources/scss/user.scss'])
</head>
<body>
    @include('partials.header')
    @include('partials.sidebar')
    <div class="main-content">
        @yield('content')
    </div>
    <!-- Incluir JS con Vite -->
    @vite('resources/js/app.js')
</body>
</html>
