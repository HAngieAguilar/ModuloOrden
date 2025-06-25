<?php
require_once 'Conexion.php';

if (!isset($_GET['token'])) {
    header('Location: enlaceExpirado.html');
    exit;
}

$token = trim($_GET['token']);

try {
    $pdo = Database::connect();
    $stmt = $pdo->prepare("SELECT idUsuario FROM usuario WHERE token = :token AND token_expira > NOW() LIMIT 1");
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        header('Location: enlaceExpirado.html');
        exit;
    }

} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Recuperar Contraseña</title>

  <link rel="stylesheet" href="CambiarContraseña.css">

  <!-- Tipografías -->
  <link href="https://fonts.googleapis.com/css2?family=Protest+Strike&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Kay+Pho+Du&display=swap" rel="stylesheet" />
</head>

<body>
  <div class="container-fluid">
    <div class="left-section"></div>

    <div class="right-section">
      <div class="form-container">
        <div class="logo">
          <img src="img/logo.png" alt="Logo RunnerCar" />
        </div>

        <div class="text-wrap">
          <h1>Recuperar Contraseña</h1>
          <p>RunnerCar</p>
        </div>

        <form id="DatosContraseña" method="POST" action="guardarContraseñaNueva.php">
          <!-- Contraseña nueva -->
          <input type="password" id="nueva" name="contraseña" class="input-bold" placeholder="Contraseña Nueva" required />
          <p class="error-mensaje"></p>

          <input type="password" id="repetir" name="contraseñaConfir" class="input-bold" placeholder="Confirmar Contraseña" required />
          <p class="error-mensaje"></p>

           <input type="hidden" name="codigo" value="<?php echo htmlspecialchars($token); ?>">

          <button type="submit" class="login-btn">Guardar</button>
        </form>
      </div>
    </div>
  </div>

  
  
  <script src="CambiarContraseña.js"></script>
</body>
</html>
