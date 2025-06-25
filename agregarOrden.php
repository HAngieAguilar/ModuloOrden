<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden De Trabajo</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
    <link rel="stylesheet" href="agregarOrden.css" />
</head>
<body>
    
<aside class="sidebar">
    <!-- Sidebar Header -->
    <header class="sidebar-header">
      <a href="#" class="header-logo">
        <img class="logotipo" id="miBoton" src="../img/login/logo.png" alt="Logo">
      </a>
      <button class="toggler sidebar-toggler">
        <span class="material-symbols-rounded">chevron_left</span>
      </button>
      <button class="toggler menu-toggler">
        <span class="material-symbols-rounded">menu</span>
      </button>
    </header>

    <!-- Navegación Sidebar -->
    <nav class="sidebar-nav">
      <!-- Navegación principal -->
      <!-- Sidebar Navegación actualizada con <span> en lugar de <samp> -->
    <ul class="nav-list primary-nav">
      <li class="nav-item">
        <a href="Dashboard.php" class="nav-link">
          <span class="imagenes_pt1"><img src="../img/barra/casa.png "class="imagenes1" alt=""></span>
          <span class="nav-label">Home</span>
        </a>
        <span class="nav-tooltip">Home</span>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <span class="imagenes_pt1"><img src="../img/barra/orden.png" class="imagenes1" alt=""></span>
          <span class="nav-label">Orden de trabajo</span>
        </a>
        <span class="nav-tooltip">Orden de trabajo</span>
      </li>

      <li class="nav-item">
        <a href="Empleados.php" class="nav-link">
          <span class="imagenes_pt1"><img src="../img/barra/empleado.png" class="imagenes4" alt=""></span>
          <span class="nav-label">Empleados</span>
        </a>
        <span class="nav-tooltip">Empleados</span>
      </li>

      <li class="nav-item">
        <a href="citas.php" class="nav-link">
          <span class="imagenes_pt1"><img src="../img/barra/citas.png" class="imagenes1" alt=""></span>
          <span class="nav-label">Citas</span>
        </a>
        <span class="nav-tooltip">Citas</span>
      </li>

      <li class="nav-item">
        <a href="inventario.php" class="nav-link">
          <span class="imagenes_pt1"><img src="../img/barra/almacen.png" class="imagenes1" alt=""></span>
          <span class="nav-label">Inventario</span>
        </a>
        <span class="nav-tooltip">Inventario</span>
      </li>
    </ul>


      <!-- Navegación secundaria -->
      <ul class="nav-list secondary-nav">
        <li class="nav-item">
          <a href="#" class="nav-link">
            <samp class="imagenes_pt1"><img src="../img/barra/ajustes.png" class="imagenes1" alt=""></samp>
            <span class="nav-label">Ajustes</span>
          </a>
          <span class="nav-tooltip">Ajustes</span>
        </li>

        <li class="nav-item">
         <a href="../../controllers/logout.php" class="nav-link">
            <samp class="imagenes_pt1"><img src="../img/barra/cerrar.png" class="imagenes3" alt=""></samp>
            <span class="nav-label">Cerrar sesión</span>
          </a>
          <span class="nav-tooltip">Cerrar sesión</span>
        </li>
      </ul>
    </nav>
  </aside>
<!-- Fin del codigo barra lateral -->

<!-- Inicio codigo vista general -->

<!-- Inicio código contenido principal -->
<div class="contenidoPrincipal">

  <div class="parteSuperior">
    <div class="barraBusqueda">
        <input class="lupa" id="espacioBusqueda" type="text" placeholder="Realice su orden de trabajo...">
    </div>

    <div class="BotonAgregar">
        <button id="NuevaOrden">Nueva Orden De Trabajo</button>
    </div>
  </div>

  <div class="cajasOrdenes">
    <?php
    require_once 'Conexion.php';

    try {
        $db = Database::connect();
        $stmt = $db->prepare("CALL DatosGeneralesOrden()");
        $stmt->execute();
        $infoGeneral = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($infoGeneral as $fila) {
            ?>
            <div class="bloqueOrden">
                <div class="bloqueAdentro">
                    <div class="fila-superior">
                        <span class="estado"><strong><?php echo $fila['idOrdenDeTrabajo']; ?></strong></span>
                        <span class="placa"><strong><?php echo $fila['Placa']; ?></strong></span>
                    </div>
                    <div class="infoOrden">
                        <p><?php echo $fila['Tecnico']; ?></p>
                        <p>Vehículo: <?php echo $fila['Vehiculo']; ?></p>
                        <p>Color: <?php echo $fila['Color']; ?></p>
                    </div>
                    <hr>

                    


                    <a id="verMas" href="verOrdenTrabajo.php?id=<?= $fila['idOrdenDeTrabajo'] ?>">Ver más</a>


                </div>
            </div>
            <?php
        }

        $stmt->closeCursor(); 

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
  </div>

</div> <!-- Fin de contenidoPrincipal -->




<script src="agregarOrden.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
