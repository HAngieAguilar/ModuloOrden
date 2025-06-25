<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Recuperar Contraseña</title>
  <link rel="stylesheet" href="solicitar_Correo.css" />

  <!-- Link a las tipografias -->
  <link href="https://fonts.googleapis.com/css2?family=Kay+Pho+Du&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Protest+Strike&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>
<body>

  <div class="container">
    <!-- Columna izquierda: formulario -->
    <div class="left-section">
      <a href="#" class="back-button">←</a>
      <div class="form-container">
        <h2>Recuperar Contraseña</h2>
        <p><strong>Ingrese su  correo electronico para recibir el enlace de recuperacion de contraseña</strong></p>
        
        <!-- Formulario dodne se solicita el correo electronico-->
        <form class="correoSolicitud" id="formularioCorreo" method="POST" action="MandarCorreo.php">
          <input type="email"  name="correo" class="input" id="correo" placeholder="Correo electrónico" required>
          <div id="error-correo" class="error-message"></div>
          <button class="btn" type="submit">Enviar</button>
        </form>
        


      </div>
    </div>

    <!-- Columna derecha: imagen -->
    <div class="right-section">
      <div class="overlay"></div>
      <img src="../Codigo/views/img/carro2.jpg" alt="Imagen auto" class="car-img">
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="alertasCorreo.js"></script>

  <script src="validacionesCorreo.js"></script>
</body>
</html>

