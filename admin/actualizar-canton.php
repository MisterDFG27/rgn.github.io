<?php

//Seleccionamos todos los provincia
//nos conectamos a la base de datos
include("conexion.php");

//Obtenemos la propiedad en base al id que recibimos por GET
include("conexion.php");
$id_canton = $_GET['id'];

//Armamos el query para seleccionar la propiedad
$query = "SELECT * FROM canton WHERE id='$id_canton'";

//Ejecutamos la consulta
$result = mysqli_query($conn, $query);
$canton = mysqli_fetch_assoc($result);



//obtenemos todos los provincia
$query = "SELECT * FROM provincia";
$resultado_provincia = mysqli_query($conn, $query);

if (isset($_GET['modificar'])) {
    //nos conectamos a la base de datos
    include("conexion.php");

    //tomamos los datos que vienen del formulario
    $id = $_GET['id'];
    $id_provincia = $_GET['provincia'];
    $nombre_canton = $_GET['nombre_canton'];

    //armamos el query para actualizar el provincia
    $query = "UPDATE canton SET id_provincia='$id_provincia', nombre_canton='$nombre_canton' WHERE id='$id'" ;

    //actualizamos en la tabla provincia
    if (mysqli_query($conn, $query)) { //Se actualizo correctamente
        $mensaje = "La canton se actualizó correctamente";
    } else {
        $mensaje = "No se pudo actualizar en la BD" . mysqli_error($conn);
    }
}


?>




<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
    <title>RGN Asesores</title>
</head>

<body>
    <?php include("header.php"); ?>
    <div id="contenedor-admin">
        <?php include("contenedor-menu.php"); ?>

        <div class="contenedor-principal">
            <div id="nueva-canton">
                <h2>Actualizar canton</h2>
                <hr>

                <div class="box-nuevo-tipo">
                    <h3>Actualizar canton</h3>
                    <hr>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
                        <label for="provincia">Seleccione el provincia</label>
                        <input type="hidden" name="id" value="<?php echo $canton['id'] ?>"> 

                        <select name="provincia" id="" class="input-entrada-texto">
                            <?php while ($row = mysqli_fetch_assoc($resultado_provincia)) : ?>
                                <?php if ($row['id'] == $canton['id_provincia']) : ?>
                                    <option value="<?php echo $row['id'] ?>" selected>
                                        <?php echo $row['nombre_provincia'] ?>
                                    </option>
                                <?php else : ?>
                                    <option value="<?php echo $row['id'] ?>">
                                        <?php echo $row['nombre_provincia'] ?>
                                    </option>
                                <?php endif ?>
                            <?php endwhile ?>
                        </select>
                        <input type="text" name="nombre_canton" value="<?php echo $canton['nombre_canton']?>" placeholder="Nombre de la canton">
                        <input type="submit" name="modificar" value="Modificar" class="btn-accion">
                    </form>

                    <?php if (isset($_GET['modificar'])) : ?>
                        <script>
                            alert("<?php echo $mensaje ?>");
                            window.location.href = 'index.php';
                        </script>


                    <?php endif ?>


                </div>

            </div>
        </div>
    </div>
</body>