<?php

/********************************************************/
//SELECCIONAMOS LOS TIPOS DE PROPIEDADES
//nos conectamos a la base de datos
include("conexion.php");

//Armamos el query para seleccionar los tipos
$query = "SELECT * FROM tipos";

//Ejecutamos la consulta
$resultado_tipos = mysqli_query($conn, $query);
/******************************************************/

/********************************************************/
//SELECCIONAMOS LOS provincia
//nos conectamos a la base de datos
include("conexion.php");

//Armamos el query para seleccionar los provincia
$query = "SELECT * FROM provincia";
$query2 = "SELECT * FROM canton";
$query3 = "SELECT * FROM distrito";

//Ejecutamos la consulta
$resultado_provincia = mysqli_query($conn, $query);
$resultado_canton = mysqli_query($conn, $query2);
$resultado_distrito = mysqli_query($conn, $query3);
/********************************************************/


/******************************************************* */
//GUARDAMOS LA PROPIEDAD
if (isset($_POST['agregar'])) {
    //nos conectamos a la base de datos
    include("conexion.php");

    //tomamos los datos que vienen del formulario
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $tipo = $_POST['tipo'];
    $estado = $_POST['estado'];
    $ubicacion = $_POST['ubicacion'];
    $habitaciones = $_POST['habitaciones'];
    $banios = $_POST['banios'];
    $pisos = $_POST['pisos'];
    $garage = $_POST['garage'];
    $dimensiones = $_POST['dimensiones'];
    $precio = $_POST['precio'];
    $moneda = $_POST['moneda'];
    $url_foto_principal = "url";
    $url_galeria = "url";
    $provincia = $_POST['provincia'];
    $canton = $_POST['canton'];
    $distrito = $_POST['distrito'];

    //armamos el query para insertar en la tabla propiedades
    $query = "INSERT INTO propiedades (id, fecha_alta, titulo, descripcion, tipo, estado, ubicacion, habitaciones, banios, pisos, garage, dimensiones, precio, moneda,  url_foto_principal, provincia, canton, distrito)
    VALUES (NULL,CURRENT_TIMESTAMP, '$titulo', '$descripcion','$tipo','$estado','$ubicacion','$habitaciones','$banios','$pisos','$garage','$dimensiones','$precio', '$moneda', '', '$provincia','$canton','$distrito')";

    //insertamos en la tabla propiedades
    if (mysqli_query($conn, $query)) { //Se insertó correctamente
        include("procesar-foto-principal.php");
        include("procesar-fotos-galeria.php");
        $mensaje = "La propiedad se inserto correctamente";
    } else {
        $mensaje = "No se pudo insertar en la BD" . mysqli_error($conn);
    }
}


/******************************************************* */


?>


<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RGN Asesores</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
    <script>
        function muestraselect(str) {
            var conexion;

            if (str == "") {
                document.getElementById("canton").innerHTML = "";
                return;
            }
            if (window.XMLHttpRequest) {
                conexion = new XMLHttpRequest();
            }

            conexion.onreadystatechange = function() {
                if (conexion.readyState == 4 && conexion.status == 200) {
                    document.getElementById("canton").innerHTML = conexion.responseText;
                }
            }

            conexion.open("GET", "canton.php?c=" + str, true);
            conexion.send();

        }
    </script>
</head>

<body>
    <?php include("header.php"); ?>

    <div id="contenedor-admin">
        <?php include("contenedor-menu.php"); ?>

        <div class="contenedor-principal">
            <div id="nueva-propiedad">
                <h2>Nueva propiedad</h2>
                <hr>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" method="post">
                    <div class="fila-una-columna">
                        <label for="titulo">Título de la Propiedad</label>
                        <input type="text" name="titulo" required class="input-entrada-texto">
                    </div>

                    <div class="fila-una-colummna">
                        <label for="descripcion">Descripción de la Propiedad</label>
                        <textarea name="descripcion" id="" cols="30" rows="10" class="input-entrada-texto"></textarea>
                    </div>

                    <div class="fila">
                        <div class="box">
                            <label for="tipo">Seleccione tipo de propiedad</label>
                            <select name="tipo" id="" class="input-entrada-texto">
                                <?php while ($row = mysqli_fetch_assoc($resultado_tipos)) : ?>
                                    <option value="<?php echo $row['id'] ?>">
                                        <?php echo $row['nombre_tipo'] ?>
                                    </option>
                                <?php endwhile ?>
                            </select>
                        </div>

                        <div class="box">
                            <label for="estado">Elija estado de la propiedad</label>
                            <select name="estado" id="" class="input-entrada-texto">
                                <option value="Venta">Venta</option>
                                <option value="Alquiler">Alquiler</option>
                            </select>
                        </div>

                        <div class="box">
                            <label for="ubicacion">Ubicación</label>
                            <input type="text" name="ubicacion" class="input-entrada-texto">
                        </div>
                    </div>

                    <div class="fila">
                        <div class="box">
                            <label for="habitaciones">Habitaciones</label>
                            <input type="text" name="habitaciones" class="input-entrada-texto">
                        </div>

                        <div class="box">
                            <label for="baños">Baños</label>
                            <input type="text" name="banios" class="input-entrada-texto">
                        </div>

                        <div class="box">
                            <label for="pisos">Pisos</label>
                            <input type="text" name="pisos" class="input-entrada-texto">
                        </div>
                    </div>

                    <div class="fila">
                        <div class="box">
                            <label for="garage">Garage</label>
                            <select name="garage" id="" class="input-entrada-texto">
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>

                        <div class="box">
                            <label for="dimensiones">Dimensiones</label>
                            <input type="text" name="dimensiones" class="input-entrada-texto">
                        </div>

                        <div class="box">
                            <label for="precio">Precio (Alquiler o Venta)</label>
                            <input type="text" name="precio" class="input-entrada-texto" required>
                        </div>
                    </div>
                    
                    <div class="fila">
                        <div class="box">
                            <label for="moneda">Moneda</label>
                            <input type="text" name="moneda" class="input-entrada-texto" required value="₡">
                        </div>
                    </div>


                    <div>
                        <h2>Galería de fotos</h2>

                        <label for="foto1" class="btn-fotos"> Foto Principal</label>
                        <output id="list" class="contenedor-foto-principal">
                            <img src="<?php echo $propiedad['url_foto_principal'] ?>" alt="">
                        </output>
                        <input type="file" id="foto1" accept="image/*" name="foto1" style="display:none">
                    </div>

                    <div>
                        <label for="fotos" class="btn-fotos"> Galería de Fotos </label>

                        <div id="contenedor-fotos-publicacion">

                        </div>


                        <input type="file" id="fotos" accept="image/*" name="fotos[]" value="Foto" multiple="" required style="display:none">
                    </div>


                    <h2>Ubicación</h2>
                    <div class="fila">
                        <div class="box">
                            <label for="provincia">Seleccione la provincia de la Propiedad</label>
                            <select name="provincia" id="" onchange="muestraselect(this.value)" class="input-entrada-texto">
                                <option value="">Seleccione provincia</option>
                                <?php while ($row = mysqli_fetch_assoc($resultado_provincia)) : ?>
                                    <option value="<?php echo $row['id'] ?>">
                                        <?php echo $row['nombre_provincia'] ?>
                                    </option>
                                <?php endwhile ?>
                            </select>
                        </div>
                        <div class="box">
                            <label for="canton">Seleccione el canton de la Propiedad</label>
                            <select name="canton" id="" onchange="muestraselect(this.value)" class="input-entrada-texto">
                                <option value="">Seleccione canton</option>
                                <?php while ($row = mysqli_fetch_assoc($resultado_canton)) : ?>
                                    <option value="<?php echo $row['id'] ?>">
                                        <?php echo $row['nombre_canton'] ?>
                                    </option>
                                <?php endwhile ?>
                            </select>
                        </div>

                        <div class="box">
                            <label for="distrito">Seleccione el distrito de la Propiedad</label>
                            <select name="distrito" id="" onchange="muestraselect(this.value)" class="input-entrada-texto">
                                <option value="">Seleccione distrito</option>
                                <?php while ($row = mysqli_fetch_assoc($resultado_distrito)) : ?>
                                    <option value="<?php echo $row['id'] ?>">
                                        <?php echo $row['nombre_distrito'] ?>
                                    </option>
                                <?php endwhile ?>
                            </select>
                        </div> 
                        </div>
                    <hr>
                    <input type="submit" value="Agregar Propiedad" name="agregar" class="btn-accion">

                </form>

            </div>
        </div>
    </div>

    <?php if (isset($_POST['agregar'])) : ?>
        <script>
            alert("<?php echo $mensaje ?>");
            window.location.href = 'add-propiedad.php';
        </script>
    <?php endif ?>

    <script>
        $('#link-add-propiedad').addClass('pagina-activa');
    </script>

    <script src="subirfoto.js"></script>
    <script src="scriptFotos.js"></script>
</body>

</html>