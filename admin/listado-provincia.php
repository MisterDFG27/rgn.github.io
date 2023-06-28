<?php
session_start();

if (!$_SESSION['usuarioLogeado']) {
    header("Location:login.php");
}

function obtenerTodosLosprovincia()
{
    include("conexion.php");
    $query = "SELECT * FROM provincia";
    $result = mysqli_query($conn, $query);
    return $result;
}

$result = obtenerTodosLosprovincia();
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
    <link rel="stylesheet" href="prueba.css">
    <title>RGN Asesores</title>
</head>

<body>
    <?php include("header.php"); ?>
    
    <div id="contenedor-admin">
        <?php include("contenedor-menu.php"); ?>

        <div class="contenedor-principal">
            <div id="listado-provincia">
                <h2>Listado de provincia</h2>
                <hr>
                <div class="contenedor-tabla">
                    <table class="listados">
                        <tr>
                            <th>#ID</th>
                            <th>Nombre del provincia</th>
                            <th>Acciones</th>
                        </tr>

                        <?php while ($provincia = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td> <?php echo $provincia['id'] ?></td>
                                <td> <?php echo $provincia['nombre_provincia'] ?></td>
                                <td>
                                    <form action="actualizar-provincia.php" method="get" class="form-acciones">
                                        <input type="hidden" name="id" value="<?php echo $provincia['id'] ?>">
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
        $('#link-listado-provincia').addClass('pagina-activa');
    </script>
</body>

</html>