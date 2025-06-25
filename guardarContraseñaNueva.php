<?php
require_once 'Conexion.php';

if (!isset($_POST['contraseña'], $_POST['contraseñaConfir'], $_POST['codigo'])) {
    exit('Error: datos incompletos');
}

$nueva = trim($_POST['contraseña']);
$repetir = trim($_POST['contraseñaConfir']);
$token = trim($_POST['codigo']);

if ($nueva !== $repetir) {
    exit('Error: Las contraseñas no coinciden');
}

$hash = password_hash($nueva, PASSWORD_DEFAULT);

try {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT idUsuario FROM usuario WHERE token = :token AND token_expira > NOW() LIMIT 1");
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        echo "<script>window.location.href = 'enlaceExpirado.html';</script>";
        exit;
    }

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $usuario['idUsuario'];

    $update = $pdo->prepare("UPDATE usuario SET password = :password, token = NULL, token_expira = NULL WHERE idUsuario = :id");
    $update->bindParam(':password', $hash);
    $update->bindParam(':id', $id);
    $update->execute();

    echo "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Contraseña actualizada</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: 'Tu contraseña fue actualizada con éxito.',
                confirmButtonText: 'Iniciar sesión'
            }).then(() => {
                window.location.href = 'login.php';
            });
        </script>
    </body>
    </html>
    ";
} catch (PDOException $e) {
    exit("Error de base de datos: " . $e->getMessage());
}
 