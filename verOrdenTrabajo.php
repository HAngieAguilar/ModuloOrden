<?php
require_once 'Conexion.php';

if (!isset($_GET['id'])) {
    echo "ID no proporcionado";
    exit;
}

$id = $_GET['id'];

try {
    $conn = Database::connect();
    $stmt = $conn->prepare("SELECT * FROM ordendetrabajo WHERE idOrdenDeTrabajo = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $orden = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$orden) {
        echo "Orden no encontrada";
        exit;
    }

    $stmt->closeCursor();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Orden #<?= $orden['idOrdenDeTrabajo'] ?></title>
    <link rel="stylesheet" href="verOrdenTrabajo.css">
    <link href="https://fonts.googleapis.com/css2?family=Protest+Strike&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kay+Pho+Du&display=swap" rel="stylesheet" />
</head>
<body>

<div class="Formulario">
    <h1>Orden De Trabajo</h1>
    <div class="DatosOrdenTrabajo">
        <h3>Orden de trabajo #<?= $orden['idOrdenDeTrabajo'] ?></h3>

        <div class="DatosOrden">
            <div class="IdOrden">
                <label>Id Orden</label>
                <input type="number" value="<?= $orden['idOrdenDeTrabajo'] ?>" readonly>
            </div>

            <div class="NombreEmpleado">
                <label>Nombre Empleado</label>
                <input type="text" value="<?= $orden['tecnico'] ?>" readonly>
            </div>

            <div class="FechaCreacion">
                <label>Fecha de Creación</label>
                <input type="date" value="<?= $orden['fechaCreacion'] ?>" readonly>
            </div>

            <div class="CostoTotal">
                <label>Costo Total</label>
                <input type="number" value="<?= $orden['costoTotal'] ?>" readonly>
            </div>

            <div class="NombreCliente">
                <label>Nombre Cliente</label>
                <input type="text" value="<?= $orden['cliente'] ?>" readonly>
            </div>

            <div class="IdCliente">
                <label>ID Cliente</label>
                <input type="number" value="<?= $orden['id_cliente'] ?>" readonly>
            </div>
        </div>

        <h3>Datos Vehículo</h3>
        <div class="DatosVehiculo">
            <div>
                <label>Vehículo</label>
                <input type="text" value="<?= $orden['Vehiculo'] ?>" readonly>
            </div>
            <div>
                <label>Modelo</label>
                <input type="text" value="<?= $orden['Modelo'] ?>" readonly>
            </div>
            <div>
                <label>Color</label>
                <input type="text" value="<?= $orden['Color'] ?>" readonly>
            </div>
            <div>
                <label>Placa</label>
                <input type="text" value="<?= $orden['Placa'] ?>" readonly>
            </div>
            <div>
                <label>Kilometraje</label>
                <input type="number" value="<?= $orden['kilometraje'] ?>" readonly>
            </div>
            <div>
                <label>Gasolina</label>
                <input type="text" value="<?= $orden['Gasolina'] ?>" readonly>
            </div>
        </div>

        <h3>Descripción del Vehículo</h3>
        <div class="EntradaDescripcion">
            <textarea class="entradaD" readonly><?= $orden['descripcion'] ?></textarea>
        </div>

        <h3>Servicios Realizados</h3>
        <div class="EntradaServicios">
            <textarea class="entradaS" readonly><?= $orden['servicios'] ?></textarea>
        </div>

        <div class="botones">
            <a class="actualiza" href="editarOrden.php?id=<?= $orden['idOrdenDeTrabajo'] ?>">Actualizar Orden</a>
            
            <a href="ArchivosOrden1.php?id=<?= $orden['idOrdenDeTrabajo'] ?>" class="Envio">Descargar PDF</a>
            <a href="javascript:history.back()" class="Salir">Salir</a>
        </div>
    </div>
</div>

</body>
</html>
