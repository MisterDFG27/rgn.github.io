<?php
session_start();

//Si el usuario no esta logeado lo enviamos al login
if (!(isset($_SESSION['usuarioLogeado']) && $_SESSION['usuarioLogeado'] != '')) {
    header("Location: login.php");
}

include("funciones.php");

//con la función obtenerTotalRegistros obtengo el total de registros de una tabla
// el nombre de la tabla lo mando por paramaetro
$totalPropiedades = obtenerTotalRegistros('propiedades');
$totalTipos = obtenerTotalRegistros('tipos');
$totalprovincia = obtenerTotalRegistros('provincia');
$totacanton = obtenerTotalRegistros('canton');
$totadistrito = obtenerTotalRegistros('distrito');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
    <title>RGN Asesores</title>
</head>

<body>
    <?php include("header.php"); ?>
    <div id="contenedor-admin">
        <?php include("contenedor-menu.php"); ?>

        <div class="contenedor-principal">
            <div id="dashboard">
                <h2>Dashboard</h2>
                <hr>
                <div class="contenedor-cajas-info">
                    <div class="caja-info propiedades">
                        <p>Total Propiedades</p>
                        <hr>
                        <span class="dato"> <?php echo $totalPropiedades ?></span>
                        <hr>
                        <a href="listado-propiedades.php">Ver Detalles</a>
                    </div>
                    <div class="caja-info tipo">
                        <p>Total Tipo de Propiedades</p>
                        <hr>
                        <span class="dato"> <?php echo $totalTipos ?></span>
                        <hr>
                        <a href="listado-tipo-propiedades.php">Ver Detalles</a>
                    </div>
                    <div class="caja-info provincia">
                        <p>Total provincias</p>
                        <hr>
                        <span class="dato"><?php echo $totalprovincia ?></span>
                        <hr>
                        <a href="listado-provincia.php">Ver Detalles</a>
                    </div>
                    <div class="caja-info canton">
                        <p>Total cantones</p>
                        <hr>
                        <span class="dato"><?php echo $totacanton ?></span>
                        <hr>
                        <a href="listado-canton.php">Ver Detalles</a>
                    </div>
                    <div class="caja-info distrito">
                        <p>Total distritos</p>
                        <hr>
                        <span class="dato"><?php echo $totadistrito ?></span>
                        <hr>
                        <a href="listado-distrito.php">Ver Detalles</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#link-dashboard').addClass('pagina-activa');
    </script>

</body>

</html>