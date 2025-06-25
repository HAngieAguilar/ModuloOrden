<?php
require_once 'Conexion.php';

try {
    $conn = Database::connect();

    // Recibir datos
    $Nombre_Tecnico = $_POST['TecnicoName'];
    $Fecha_Creacion = $_POST['FechaCreacionName'];
    $Costo_Total = $_POST['CostoTotalName'];
    $Nombre_Cliente = $_POST['ClienteName'];
    $Id_Cliente = $_POST['IdClienteName'];
    $Nombre_Vehiculo = $_POST['VehiculoName'];
    $Modelo = $_POST['ModeloName'];
    $Nombre_Color = $_POST['ColorName'];
    $Placa = $_POST['PlacaName'];
    $Kilometraje = $_POST['KilometrajeName'];
    $Gasolina = $_POST['GasolinaName'];
    $Caja_Descripcion = $_POST['descripcion'];
    $Caja_Servicios = $_POST['servicios'];

    $query = "CALL Ingreso_Orden( :nombreTecnico, :fechaCreacion, :costoTotal, :nombreCliente, :idCliente, :vehiculo, :modelo, :color, :placa, :kilometraje, :gasolina, :descripcion, :servicios)";
    $stmt = $conn->prepare($query);

    // Aquí las variables coinciden
    $stmt->bindParam(':nombreTecnico', $Nombre_Tecnico);
    $stmt->bindParam(':fechaCreacion', $Fecha_Creacion);
    $stmt->bindParam(':costoTotal', $Costo_Total);
    $stmt->bindParam(':nombreCliente', $Nombre_Cliente);
    $stmt->bindParam(':idCliente', $Id_Cliente);
    $stmt->bindParam(':vehiculo', $Nombre_Vehiculo);
    $stmt->bindParam(':modelo', $Modelo);
    $stmt->bindParam(':color', $Nombre_Color);
    $stmt->bindParam(':placa', $Placa);
    $stmt->bindParam(':kilometraje', $Kilometraje);
    $stmt->bindParam(':gasolina', $Gasolina);
    $stmt->bindParam(':descripcion', $Caja_Descripcion);
    $stmt->bindParam(':servicios', $Caja_Servicios);

    $stmt->execute();
    
    header("Location: agregarOrden.php");
    exit;
} catch (PDOException $e) {
    echo "Existio un Error: " . $e->getMessage();
}
?>
