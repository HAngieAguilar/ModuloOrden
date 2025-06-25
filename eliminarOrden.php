<?php
require_once 'Conexion.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID no proporcionado";
    exit;
}

$id = $_GET['id'];

try {
    $conn = Database::connect();

    $stmt = $conn->prepare("DELETE FROM ordendetrabajo WHERE idOrdenDeTrabajo = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Redirige a la vista general después de eliminar
    header("Location: agregarOrden.php?mensaje=eliminada");
    exit;

} catch (PDOException $e) {
    echo "Error al eliminar la orden: " . $e->getMessage();
}
?>
