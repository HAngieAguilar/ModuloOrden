
<?php
require_once 'Conexion.php';

try {
    $conn = Database::connect();

    // Obtener el siguiente ID autoincremental
    $stmt = $conn->query("SHOW TABLE STATUS LIKE 'ordendetrabajo'");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $idxOrden = $row['Auto_increment'];

} catch (PDOException $e) {
    $idxOrden = "Error";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" href="Formulario_Estilo.css">
     rel="stylesheet" <link href="https://fonts.googleapis.com/css2?family=Protest+Strike&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Kay+Pho+Du&display=swap"/>
</head>
<body>

    <div class="Formulario">
        
        <h1>Orden De Trabajo</h1>
        <div class="DatosOrdenTrabajo">
        <h3>Datos Orden</h3>
        <form id="formulario_Orden" action="NuevaOrden.php" method="post">
            <div class="DatosOrden" id="DatosOrden">
                
                <div class="IdOrden">
                    <label class="EntradaIdOrden" for="IdOrdenInput">Id Orden</label>
                    <input type="number" class="IdOrden" id="IdOrdenInput" value="<?php echo $idxOrden; ?>" readonly>
                </div>
    
                <div class="NombreEmpleado">
                    <label class="EntradaNombreEmpleado">Nombre Empleado</label>
                    <input type="text" class="NombreTecnico" name="TecnicoName" id="TecnicoInput" required>
                </div>
                
                <div class="FechaCreacion">
                    <label class="EntradaFechaCreacion" for="FechaCreacionInput">Fecha de Creación</label>
                    <input type="date" class="FechaCreacion" name="FechaCreacionName" id="FechaCreacionInput" required>
                </div>
                
                
                <div class="CostoTotal">
                    <label class="EntradaCostoTotal" for="CostoTotalInput">Costo Total</label>
                    <input type="number" step="0.01" class="CostoTotal" name="CostoTotalName" id="CostoTotalInput" required>
                </div>
    
                
                <div class="NombreCliente">
                    <label class="EntradaNombreCliente" for="NombreInput">Nombre</label>
                    <input type="text" class="NombreCliente" name="ClienteName" id="NombreInput" required>
    
                </div>
    
                <div class="IdCliente">
                    <label class="EntradaIdCliente" for="IdClienteInput">Id Cliente</label>
                    <input type="number" class="IdCliente" name="IdClienteName" id="IdClienteInput" required>
                </div>

            </div>


            
    <div class="DatosCarro">
        <h3>Datos Vehiculo</h3>
        <div class="DatosVehiculo" id="datosCarro">
            
        <div class="Vehiculo">
            <label class="EntradaVehiculo" for="VehiculoInput">Vehículo</label>
            <input type="text" class="Vehiculo" name="VehiculoName" id="VehiculoInput" required>
        </div>
        
        <div class="Modelo">
            <label class="EntradaModelo" for="ModeloInput">Modelo</label>
            <input type="number" class="Modelo" name="ModeloName" id="ModeloInput" required>
        </div>
        
        <div class="Color">
            <label class="EntradaColor" for="ColorInput">Color</label>
            <input type="text" class="Color" name="ColorName" id="ColorInput" required>
        </div>
        
        <div class="Placa">
            <label class="EntradaPlaca" for="PlacaInput">Placa</label>
            <input type="text" class="Placa" name="PlacaName" id="PlacaInput" required>
        </div>

        <div class="Kilometraje">
            <label class="EntradaKilometraje" for="KilometrajeInput">Kilometraje</label>
            <input type="number" step="0.01" class="Kilometraje" name="KilometrajeName" id="KilometrajeInput" required>
        </div>
        
        <div class="Gasolina">
            <label class="EntradaGasolina" for="GasolinaInput">Gasolina</label>
            <input type="text" step="0.01" class="Gasolina" name="GasolinaName" id="GasolinaInput" required>

        </div>
        </div>


        <div class="cajasDeTexto">
            <div class="DatosCajas" id="datoTexto">
                <div class="cajas">
                    <div class="CajaDescripcion">
                        <div class="AñadirDescripcion" id="FormularioDescripcion">
                            <label class="EntradaDescripcion" for="DescripcionInput">Descripción del Vehiculo:</label><br>
                            <textarea class="entradaD" id="descripcion" name="descripcion" rows="4" cols="50" placeholder="Escribe aquí la descripción..."></textarea><br>
                        </div>
                    </div>
                    <div class="cajaServicios">
                        <div class="AñadirServicios" id="FormularioServicios">
                            <label class="EntradaServicios" for="ServicioInput">Descripción de los servicios</label><br>
                            <textarea class="entradaS" id="servicios" name="servicios" rows="4" cols="50" placeholder="Escriba Los servecios..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

        </div>

        <div class="botones">
            <button name="guardar" type="submit" class="Envio" >Enviar Formulario</button>
            <a  href="agregarOrden.php" class="Salir" onclick="">Salir Del Formulario</a>
        </div>
    
        </form>
        




    

        
       

    </div>

    </div>
    



   
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="formulario_validaciones.js"></script>
