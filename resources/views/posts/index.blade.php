<html>
  <header>
      <title>Iniciar Sesion</title>
  </header>
  <body>
    <h1>Plataforma de vinculacion</h1>
    <br><br>
    <label>Iniciar Sesion</label>
    <br><br>
    <label>Email</label>
    <br>
    <input type="text">
    <br>
    <label>Contraseña</label>
    <br>
    <input type="password">
    <br>
    <br>
    <button onclick="window.location.href='{{route('usuarios.create')}}'">Registrarse</button><br>
    <button onclick="window.location.href='{{route('recuperar')}}'">Recuperar cuenta</button><br>
    <!-- <button>Registrar Institución</button><br> -->
  </body>
</html>
