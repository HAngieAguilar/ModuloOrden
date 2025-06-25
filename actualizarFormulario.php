

<?php
require_once 'Conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $conn = Database::connect();

        $stmt = $conn->prepare("CALL Actualizar_Orden(
            :ordenId, :nombreTecnico, :fechaCreada, :totalCosto,
            :nombreCliente, :clienteId, :nombreVehiculo, :anioModelo,
            :colorVehiculo, :placaVehiculo, :kmActual, :nivelGasolina,
            :textoDescripcion, :textoServicios
        )");


        
        $stmt->execute([
            ':ordenId' => $_POST['id'],
            ':nombreTecnico' => $_POST['tecnico'],
            ':fechaCreada' => $_POST['fechaCreacion'],
            ':totalCosto' => $_POST['costoTotal'],
            ':nombreCliente' => $_POST['cliente'],
            ':clienteId' => $_POST['id_cliente'],
            ':nombreVehiculo' => $_POST['Vehiculo'],
            ':anioModelo' => $_POST['Modelo'],
            ':colorVehiculo' => $_POST['Color'],
            ':placaVehiculo' => $_POST['Placa'],
            ':kmActual' => $_POST['kilometraje'],
            ':nivelGasolina' => $_POST['Gasolina'],
            ':textoDescripcion' => $_POST['descripcion'],
            ':textoServicios' => $_POST['servicios']
        ]);

        header("Location: agregarOrden.php?id=" . $_POST['id']);
        exit;

    } catch (PDOException $e) {
        echo "Error al actualizar la orden: " . $e->getMessage();
    }
} else {
    echo "Solicitud inválida.";
}
