<?php
require_once 'libreriaDoc/autoload.inc.php';
use Dompdf\Dompdf;

require_once 'Conexion.php';

if (!isset($_GET['id'])) {
    exit('ID no proporcionado');
}

$id = $_GET['id'];
$conn = Database::connect();
$stmt = $conn->prepare("SELECT * FROM ordendetrabajo WHERE idOrdenDeTrabajo = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$orden = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$orden) {
    exit("Orden no encontrada");
}

ob_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Orden de Trabajo #<?= $orden['idOrdenDeTrabajo'] ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Protest+Strike&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Kay+Pho+Du&display=swap');

        body {
            font-family: 'Kay Pho Du', serif;
            background-color: #f9f9f9;
            color: #1E3D59;
            margin: 0;
            padding: 20px;
        }

        .Formulario {
            max-width: 850px;
            margin: 0 auto;
            border: 2px solid #A71818;
            padding: 30px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .parteSuperior {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .parteSuperior img {
            height: 65px;
            margin-bottom: 10px;
        }

        .parteSuperior h1 {
            font-family: 'Protest Strike', sans-serif;
            font-size: 24px;
            color: #A71818;
            margin: 5px 0;
        }

        h3 {
            font-family: 'Protest Strike', sans-serif;
            padding: 8px;
            text-align: center;
            margin: 25px 0 15px 0;
            border-radius: 5px;
            font-size: 18px;
            background-color: #1E3D59;
            color: white;
        }

        /* Sistema de 3 columnas fijas */
        .row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 13px;
            color: #555;
            margin-bottom: 5px;
            font-family: 'Protest Strike', sans-serif;
        }

        input {
            padding: 8px 10px;
            border: 1px solid #ddd;
            background-color: #f8f8f8;
            border-radius: 4px;
            font-size: 14px;
            width: 100%;
            box-sizing: border-box;
        }

        textarea {
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f8f8f8;
            border-radius: 4px;
            font-size: 14px;
            min-height: 80px;
            resize: none;
            width: 100%;
            box-sizing: border-box;
        }

        .full-row {
            grid-column: 1 / span 3;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>

<div class="Formulario">
    <div class="parteSuperior">
        <img src="logo.png" alt="LogoRunnerCar">
        <h1>Orden De Trabajo #<?= $orden['idOrdenDeTrabajo'] ?></h1>
    </div>

    <h3>Datos Generales</h3>
    <div class="row">
        <div class="form-group">
            <label>ID Orden</label>
            <input type="text" value="<?= $orden['idOrdenDeTrabajo'] ?>" readonly>
        </div>
        <div class="form-group">
            <label>Nombre Empleado</label>
            <input type="text" value="<?= $orden['tecnico'] ?>" readonly>
        </div>
        <div class="form-group">
            <label>Fecha de Creación</label>
            <input type="text" value="<?= $orden['fechaCreacion'] ?>" readonly>
        </div>
    </div>
    
    <div class="row">
        <div class="form-group">
            <label>Costo Total</label>
            <input type="text" value="<?= $orden['costoTotal'] ?>" readonly>
        </div>
        <div class="form-group">
            <label>Nombre Cliente</label>
            <input type="text" value="<?= $orden['cliente'] ?>" readonly>
        </div>
        <div class="form-group">
            <label>ID Cliente</label>
            <input type="text" value="<?= $orden['id_cliente'] ?>" readonly>
        </div>
    </div>

    <h3>Datos del Vehículo</h3>
    <div class="row">
        <div class="form-group">
            <label>Vehículo</label>
            <input type="text" value="<?= $orden['Vehiculo'] ?>" readonly>
        </div>
        <div class="form-group">
            <label>Modelo</label>
            <input type="text" value="<?= $orden['Modelo'] ?>" readonly>
        </div>
        <div class="form-group">
            <label>Color</label>
            <input type="text" value="<?= $orden['Color'] ?>" readonly>
        </div>
    </div>
    
    <div class="row">
        <div class="form-group">
            <label>Placa</label>
            <input type="text" value="<?= $orden['Placa'] ?>" readonly>
        </div>
        <div class="form-group">
            <label>Kilometraje</label>
            <input type="text" value="<?= $orden['kilometraje'] ?>" readonly>
        </div>
        <div class="form-group">
            <label>Gasolina</label>
            <input type="text" value="<?= $orden['Gasolina'] ?>" readonly>
        </div>
    </div>

    <h3>Descripción del Vehículo</h3>
    <div class="row">
        <div class="form-group full-row">
            <textarea readonly><?= $orden['descripcion'] ?></textarea>
        </div>
    </div>

    <h3>Servicios Realizados</h3>
    <div class="row">
        <div class="form-group full-row">
            <textarea readonly><?= $orden['servicios'] ?></textarea>
        </div>
    </div>

    <div class="footer">
        <p>Documento generado el <?= date('d/m/Y H:i') ?> - RunnerCar</p>
    </div>
</div>

</body>
</html>

<?php
$html = ob_get_clean();

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("orden_{$orden['idOrdenDeTrabajo']}.pdf", ["Attachment" => false]);
exit;
