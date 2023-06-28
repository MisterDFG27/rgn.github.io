<?php
session_start();

if (!$_SESSION['usuarioLogeado']) {
    header("Location:login.php");
}

function obtenerTodasLasdistrito()
{
    include("conexion.php");
    $query = "SELECT * FROM distrito";
    $result = mysqli_query($conn, $query);
    return $result;
}

function obtenercanton($id_canton)
{
    include("conexion.php");
    $query = "SELECT * FROM canton WHERE id='$id_canton'";

    //Ejecutamos la consulta
    $resultado_canton = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado_canton);
    return $row['nombre_canton'];
}

$result = obtenerTodasLasdistrito();
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
            <div id="listado-canton">
                <h2>Listado de distritos</h2>
                <hr>

                <div class="contenedor-tabla">
                    <table class="listados">
                        <tr>
                            <th>#ID</th>
                            <th>Nombre del canton</th>
                            <th>Nombre del distrito</th>
                            <th>Acciones</th>
                        </tr>

                        <?php while ($distrito = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td> <?php echo $distrito['id'] ?></td>
                                <td> <?php echo obtenercanton($distrito['id_canton']) ?></td>
                                <td> <?php echo $distrito['nombre_distrito'] ?></td>
                                <td>
                                    <form action="actualizar-distrito.php" method="get" class="form-acciones">
                                        <input type="hidden" name="id" value="<?php echo $distrito['id'] ?>">
                                        <input type="submit" value="Actualizar" name="actualizar">
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script>
        $('#link-listado-distrito').addClass('pagina-activa');
    </script>
</body>

</html>