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
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $orden = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$orden) {
        echo "Orden no encontrada";
        exit;
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Orden #<?= htmlspecialchars($orden['idOrdenDeTrabajo']) ?></title>
    <link rel="stylesheet" href="Formulario_Estilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Protest+Strike&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kay+Pho+Du&display=swap" rel="stylesheet" />
</head>
<body>

<div class="Formulario">
    <h1>Editar Orden de Trabajo</h1>

    <form action="actualizarFormulario.php" method="post">
        <div class="DatosOrdenTrabajo">
            <h3>Datos Orden</h3>
            <div class="DatosOrden" id="DatosOrden">
                <input type="hidden" name="id" value="<?= $orden['idOrdenDeTrabajo'] ?>">

                <div class="IdOrden">
                    <label class="EntradaIdOrden">ID Orden</label>
                    <input type="number" class="IdOrden" value="<?= $orden['idOrdenDeTrabajo'] ?>" readonly>
                </div>

                <div class="NombreEmpleado">
                    <label class="EntradaNombreEmpleado">Nombre Empleado</label>
                    <input type="text" class="NombreTecnico" name="tecnico" value="<?= $orden['tecnico'] ?>" required>
                </div>

                <div class="FechaCreacion">
                    <label class="EntradaFechaCreacion">Fecha de Creación</label>
                    <input type="date" class="FechaCreacion" name="fechaCreacion" value="<?= $orden['fechaCreacion'] ?>" required>
                </div>

                <div class="CostoTotal">
                    <label class="EntradaCostoTotal">Costo Total</label>
                    <input type="number" step="0.01" class="CostoTotal" name="costoTotal" value="<?= $orden['costoTotal'] ?>" required>
                </div>

                <div class="NombreCliente">
                    <label class="EntradaNombreCliente">Nombre Cliente</label>
                    <input type="text" class="NombreCliente" name="cliente" value="<?= $orden['cliente'] ?>" required>
                </div>

                <div class="IdCliente">
                    <label class="EntradaIdCliente">ID Cliente</label>
                    <input type="number" class="IdCliente" name="id_cliente" value="<?= $orden['id_cliente'] ?>" required>
                </div>
            </div>

            <h3>Datos Vehículo</h3>
            <div class="DatosVehiculo">
                <div class="Vehiculo">
                    <label class="EntradaVehiculo">Vehículo</label>
                    <input type="text" class="Vehiculo" name="Vehiculo" value="<?= $orden['Vehiculo'] ?>" required>
                </div>

                <div class="Modelo">
                    <label class="EntradaModelo">Modelo</label>
                    <input type="text" class="Modelo" name="Modelo" value="<?= $orden['Modelo'] ?>" required>
                </div>

                <div class="Color">
                    <label class="EntradaColor">Color</label>
                    <input type="text" class="Color" name="Color" value="<?= $orden['Color'] ?>" required>
                </div>

                <div class="Placa">
                    <label class="EntradaPlaca">Placa</label>
                    <input type="text" class="Placa" name="Placa" value="<?= $orden['Placa'] ?>" required>
                </div>

                <div class="Kilometraje">
                    <label class="EntradaKilometraje">Kilometraje</label>
                    <input type="number" class="Kilometraje" name="kilometraje" value="<?= $orden['kilometraje'] ?>" required>
                </div>

                <div class="Gasolina">
                    <label class="EntradaGasolina">Gasolina</label>
                    <input type="text" class="Gasolina" name="Gasolina" value="<?= $orden['Gasolina'] ?>" required>
                </div>
            </div>

            <div class="DatosCajas">
                <div class="cajas">
                    <div class="CajaDescripcion">
                        <label class="EntradaDescripcion">Descripción del Vehículo</label>
                        <textarea class="entradaD" name="descripcion" rows="4" required><?= $orden['descripcion'] ?></textarea>
                    </div>

                    <div class="cajaServicios">
                        <label class="EntradaServicios">Servicios Realizados</label>
                        <textarea class="entradaS" name="servicios" rows="4" required><?= $orden['servicios'] ?></textarea>
                    </div>
                </div>
            </div>

            <div class="botones">

                <button class="Envio" type="submit">Actualizar Orden</button>
                
                <a class="Eliminar" href="eliminarOrden.php?id=<?= $orden['idOrdenDeTrabajo'] ?>" onclick="return confirm('¿Estás seguro de eliminar esta orden?');">Eliminar Orden</a>
                <a class="Salir" href="agregarOrden.php">Cancelar</a>
            </div>
        </div>
    </form>
</div>


</body>
</html>
