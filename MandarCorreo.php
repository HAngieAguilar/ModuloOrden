<?php
require_once 'Conexion.php';


require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

header('Content-Type: application/json');

if (!isset($_POST['correo']) || empty($_POST['correo'])) {
    echo json_encode(['success' => false, 'message' => 'Correo debe estar lleno']);
    exit;
}

$correo = trim($_POST['correo']);

try {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $verificar = $pdo->prepare("SELECT idUsuario FROM usuario WHERE email = :correo LIMIT 1");
    $verificar->bindParam(':correo', $correo);
    $verificar->execute();

    if ($verificar->rowCount() === 0) {
        echo json_encode(['success' => false, 'message' => 'Correo no registrado']);
        exit;
    }

    $stmt = $pdo->prepare("CALL generar_token(:correo, @token_generado, @exito)");
    $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
    $stmt->execute();

    $result = $pdo->query("SELECT @token_generado AS token, @exito AS exito")->fetch(PDO::FETCH_ASSOC);

    if ($result && $result['exito'] == 1) {
        $token = $result['token'];

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = '2904876runnercar@gmail.com';
            $mail->Password   = 'egegebpydwdhwumf';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom('2904876runnercar@gmail.com', 'Recuperación de Contraseña');
            $mail->addAddress($correo);
            $mail->isHTML(true);
            $mail->Subject = 'Código de recuperación';

          $mail->Body = "
          <div style='font-family: Arial, sans-serif; background-color:#D9D9D9; padding: 30px;'>
                <div style='max-width: 600px; margin: auto; background-color: #f4f4f4; padding: 25px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center;'>
                    <h1 style='color: #a71818; font-size: 32px; margin-bottom: 10px;'>Runnercar</h1>
                    <h2 style='color: #2c3e50; font-size: 22px; margin-bottom: 20px;'>Recuperación de Contraseña</h2>
                    <p style='color: #333; font-size: 16px;'>Ha solicitado restablecer su contraseña.</p>

                
                    <a href='http://localhost:3000/cambiarContrase%C3%B1a.php?token=$token' style='display: inline-block; margin-top: 20px; padding: 12px 24px; background-color: #2c3e50; color: white; text-decoration: none; font-weight: bold; border-radius: 5px;'>
                    Cambiar Contraseña
                    </a>
                    <p style='color: #555; font-size: 14px;'>Este enlace sera válido solo por <strong>30 minutos</strong>.</p>
                    <p style='font-size: 12px; color: #888; margin-top: 25px;'>Si usted no solicitó esto, por favor ignore este mensaje.</p>
                </div>
            </div>
            ";
            ;
            $mail->AltBody = "Tu código de recuperación es: $token";

            $mail->send();
            

            echo json_encode(['success' => true, 'message' => 'Correo enviado con éxito', 'token' => $token]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => "Error al enviar correo: {$mail->ErrorInfo}"]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al generar token o correo no válido']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión: ' . $e->getMessage()]);
}
?>
