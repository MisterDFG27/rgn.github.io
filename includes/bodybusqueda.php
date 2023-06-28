<?php
include("funciones.php");

$id_canton = $_GET['canton'];
$id_tipo = $_GET['tipo'];
$estado = $_GET['estado'];

$result_busqueda = realizarBusqueda($id_canton, $id_tipo, $estado);


$config = obtenerConfiguracion();

$result_canton = ObtenerTodasLascanton();

$result_tipos = obtenerTodosLosTipos();


?>

<html lang="es">

<link rel="stylesheet" href="css/style3.css">

<body class="page-busqueda">
    <div class="container">
        <div class="box-buscar-propiedades pos-centrada">
            <div class="box-interior">
                <p>Encuentra la propiedad que busca</p>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
                    <select name="canton" id="">
                        <option value="">Seleccione canton</option>
                        <?php while ($row = mysqli_fetch_assoc($result_canton)) : ?>
                            <option value="<?php echo $row['id'] ?>">
                                <?php echo $row['nombre_canton'] ?>
                            </option>
                        <?php endwhile ?>
                    </select>
                    <select name="tipo" id="">
                        <option value="">Tipo de Propiedad</option>
                        <?php while ($row = mysqli_fetch_assoc($result_tipos)) : ?>
                            <option value="<?php echo $row['id'] ?>">
                                <?php echo $row['nombre_tipo'] ?>
                            </option>
                        <?php endwhile ?>
                    </select>
                    <div class="estado">
                        <span>
                            <input type="radio" value="Alquiler" name="estado" checked="true">Alquiler
                        </span>
                        <span>
                            <input type="radio" value="Venta" name="estado"> Venta
                        </span>
                    </div>

                    <input type="submit" value="Buscar" name="buscar">
                </form>
            </div>

        </div>

        <div class="contenedor-busqueda">
            <h3>Resultado Busqueda: <span><?php echo obtenercanton($id_canton) . " " . obtenerTipo($id_tipo) . " " . $estado ?> <span></h3>

            <?php while ($propiedad = mysqli_fetch_assoc($result_busqueda)) : ?>
                <form action="publicacion.php" method="get" id="<?php echo $propiedad['id'] ?>">
                    <input type="hidden" value="<?php echo $propiedad['id'] ?>" name="idPropiedad">
                    <div class="resultado" onclick="document.getElementById('<?php echo $propiedad['id'] ?>').submit();">
                        <div class="contenedor-imagen">
                            <img src="<?php echo "admin/" . $propiedad['url_foto_principal'] ?>" alt="">
                        </div>
                        <div class="info">
                            <span class="titulo"><?php echo $propiedad['titulo'] ?></span>
                            <p> <i class="fa-solid fa-location-pin"></i> <?php echo $propiedad['ubicacion'] . ", " . obtenercanton($propiedad['canton']) . ", " . obtenerprovincia($propiedad['provincia']) ?></p>
                            <div class="detalles">
                                <div class="dato1">
                                    <span class="header">Tipo</span>
                                    <span class="texto"><?php echo obtenerTipo($propiedad['tipo']) ?></span>
                                </div>
                                <div class="dato1">
                                    <span class="header">Estado</span>
                                    <span class="texto"><?php echo $propiedad['estado'] ?></span>
                                </div>
                                <div class="dato1" id="detalle-ocultar">
                                    <span class="header">Habitaciones</span>
                                    <span class="texto"><?php echo $propiedad['habitaciones'] ?></span>
                                </div>
                                <div class="dato1" id="detalle-ocultar">
                                    <span class="header">Baños</span>
                                    <span class="texto"><?php echo $propiedad['banios'] ?></span>
                                </div>
                                <div class="dato1">
                                    <span class="header">Precio</span>
                                    <span class="texto"><?php echo $propiedad['moneda']?> <?php echo number_format($propiedad['precio'],0,'','.') ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php endwhile ?>


        </div>

    </div>

    <script src="script.js"></script>
</body>

</html>