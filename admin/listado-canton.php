<?php
session_start();

if (!$_SESSION['usuarioLogeado']) {
    header("Location:login.php");
}

function obtenerTodasLascanton()
{
    include("conexion.php");
    $query = "SELECT * FROM canton";
    $result = mysqli_query($conn, $query);
    return $result;
}

function obtenerprovincia($id_provincia)
{
    include("conexion.php");
    $query = "SELECT * FROM provincia WHERE id='$id_provincia'";

    //Ejecutamos la consulta
    $resultado_provincia = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado_provincia);
    return $row['nombre_provincia'];
}

$result = obtenerTodasLascanton();
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
            <div id="listado-provincia">
                <h2>Listado de canton</h2>
                <hr>

                <div class="contenedor-tabla">
                    <table class="listados">
                        <tr>
                            <th>#ID</th>
                            <th>Nombre del provincia</th>
                            <th>Nombre de la canton</th>
                            <th>Acciones</th>
                        </tr>

                        <?php while ($canton = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td> <?php echo $canton['id'] ?></td>
                                <td> <?php echo obtenerprovincia($canton['id_provincia']) ?></td>
                                <td> <?php echo $canton['nombre_canton'] ?></td>
                                <td>
                                    <form action="actualizar-canton.php" method="get" class="form-acciones">
                                        <input type="hidden" name="id" value="<?php echo $canton['id'] ?>">
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
        $('#link-listado-canton').addClass('pagina-activa');
    </script>
</body>

</html>