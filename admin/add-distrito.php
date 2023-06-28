<?php

//Seleccionamos todos los provincia
//nos conectamos a la base de datos
include("conexion.php");

//Armamos el query para seleccionar los provincia
$query = "SELECT * FROM canton";

//Ejecutamos la consulta
$resultado = mysqli_query($conn, $query);


if (isset($_POST['agregar'])) {
    //nos conectamos a la base de datos
    include("conexion.php");

    //tomamos los datos que vienen del formulario
    $id_canton = $_POST['canton'];
    $distrito = $_POST['distrito'];

    //armamos el query para insertar en la tabla distrito
    $query = "INSERT INTO distrito (id, id_canton, nombre_distrito)
    VALUES (NULL,'$id_canton', '$distrito')";

    //insertamos en la tabla canton
    if (mysqli_query($conn, $query)) { //Se insertó correctamente
        $mensaje = "La distrito se agrego correctamente";
    } else {
        $mensaje = "No se pudo insertar en la BD" . mysqli_error($conn);
    }
}
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
            <div id="nueva-distrito">
                <h2>Agregar Nueva distrito</h2>
                <hr>

                <div class="box-nuevo-tipo">
                    <h3>Agregar Nueva distrito</h3>
                    <hr>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

                        <label for="canton">Seleccione el canton</label>
                        <select name="canton" id="">
                            <?php while ($row = mysqli_fetch_assoc($resultado)) : ?>
                                <option value="<?php echo $row['id'] ?>">
                                    <?php echo $row['nombre_canton'] ?>
                                </option>
                            <?php endwhile ?>
                        </select>
                        <input type="text" name="distrito" placeholder="Nombre de la distrito">
                        <input type="submit" name="agregar" value="Agregar" class="btn-accion">
                    </form>

                    <?php if (isset($_POST['agregar'])) : ?>
                        <script>
                            alert("<?php echo $mensaje ?>");
                            window.location.href = 'index.php';
                        </script>
                    <?php endif ?>


                </div>

            </div>
        </div>
    </div>

    <script>
        $('#link-add-distrito').addClass('pagina-activa');
    </script>
</body>