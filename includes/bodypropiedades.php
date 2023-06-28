<?php
include("funciones.php");

$limInferior = 0;

$config = obtenerConfiguracion();

$result_canton = ObtenerTodasLascanton();

$result_tipos = obtenerTodosLosTipos();

$result_propiedades = cargarPropiedades($limInferior);

?>

<html lang="es">

<head>

    <link rel="stylesheet" href="css/style3.css">

    <script>
        function cargarMasPropiedades(str) {
            var conexion;

            if (str == "") {
                document.getElementById("contenedor-propiedades").innerHTML = "";
                return;
            }
            if (window.XMLHttpRequest) {
                conexion = new XMLHttpRequest();
            }

            conexion.onreadystatechange = function() {
                if (conexion.readyState == 4 && conexion.status == 200) {
                    document.getElementById("contenedor-propiedades").innerHTML += conexion.responseText;
                    document.getElementById("botonCargarMas").value = parseInt(document.getElementById("botonCargarMas").value) + 6;

                }
            }

            conexion.open("GET", "maspropiedades.php?c=" + str, true);
            conexion.send();

        }
    </script>
</head>

<body class="page-propiedades">
    <div class="container">
        
        <h2 class="titulo-seccion">Propiedades Disponibles</h2>
        <div class="contenedor-propiedades" id="contenedor-propiedades">
            <?php while ($propiedad = mysqli_fetch_assoc($result_propiedades)) : ?>
                <div class="fila">
                    <form action="publicacion.php" method="get" id="<?php echo $propiedad['id'] ?>">
                        <input type="hidden" value="<?php echo $propiedad['id'] ?>" name="idPropiedad">
                        <div class="contenedor-propiedad" onclick="document.getElementById('<?php echo $propiedad['id'] ?>').submit();">
                            <div class="contenedor-img">
                                <img src="<?php echo 'admin/' . $propiedad['url_foto_principal'] ?>" alt="">
                                <div class="estado">
                                    <?php echo $propiedad['estado'] ?>
                                </div>
                            </div>
                            <div class="info">
                                <h2><?php echo $propiedad['titulo'] ?></h2>
                                <p> <i class="fa fa-map-marker text-primary me-2"></i><?php echo $propiedad['ubicacion'] ?></p>
                                <hr>
                            </div>
                        </div>
                    </form>

                    <?php if ($propiedad = mysqli_fetch_assoc($result_propiedades)) : ?>
                        <form action="publicacion.php" method="get" id="<?php echo $propiedad['id'] ?>">
                            <input type="hidden" value="<?php echo $propiedad['id'] ?>" name="idPropiedad">
                            <div class="contenedor-propiedad" onclick="document.getElementById('<?php echo $propiedad['id'] ?>').submit();">
                                <div class="contenedor-img">
                                    <img src="<?php echo 'admin/' . $propiedad['url_foto_principal'] ?>" alt="">
                                    <div class="estado">
                                        <?php echo $propiedad['estado'] ?>
                                    </div>
                                </div>
                                <div class="info">
                                    <h2><?php echo $propiedad['titulo'] ?></h2>
                                    <p> <i class="fa fa-map-marker text-primary me-2"></i><?php echo $propiedad['ubicacion'] ?></p>
                                    <hr>
                                </div>
                            </div>
                        </form>
                    <?php endif ?>

                    <?php if ($propiedad = mysqli_fetch_assoc($result_propiedades)) : ?>
                        <form action="publicacion.php" method="get" id="<?php echo $propiedad['id'] ?>">
                            <input type="hidden" value="<?php echo $propiedad['id'] ?>" name="idPropiedad">
                            <div class="contenedor-propiedad" onclick="document.getElementById('<?php echo $propiedad['id'] ?>').submit();">
                                <div class="contenedor-img">
                                    <img src="<?php echo 'admin/' . $propiedad['url_foto_principal'] ?>" alt="">
                                    <div class="estado">
                                        <?php echo $propiedad['estado'] ?>
                                    </div>
                                </div>
                                <div class="info">
                                    <h2><?php echo $propiedad['titulo'] ?></h2>
                                    <p> <i class="fa fa-map-marker text-primary me-2"></i><?php echo $propiedad['ubicacion'] ?></p>
                                    <hr>
                                </div>
                            </div>
                        </form>
                    <?php endif ?>
                </div>
            <?php endwhile ?>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>