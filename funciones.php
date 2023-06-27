<?php
function obtenerConfiguracion()
{
    include("admin/conexion.php");
    //Comprobamos si existe el registro 1 que mantiene la configuraciòn
    //Añadimos un alias AS total para identificar mas facil
    $query = "SELECT COUNT(*) AS total FROM configuracion";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);


    if ($row['total'] == '0') {
        echo "Valor" . $row['total'];
        //No existe el registro 1 - DEBO INSERTAR el registro por primera vez
        $query = "INSERT INTO configuracion (id,user,password)
        VALUES (NULL, 'admin', 'admin')";

        if (mysqli_query($conn, $query)) { //Se insertó correctamente

        } else {
            echo "No se pudo insertar en la BD" . mysqli_error($conn);
        }
    }

    //El regist
    $query = "SELECT * FROM configuracion  WHERE id='1'";
    $result = mysqli_query($conn, $query);
    $config = mysqli_fetch_assoc($result);
    return $config;
}

function obtenerTodasLasprovincia()
{
    include("admin/conexion.php");
    $query = "SELECT * FROM provincia";
    $result = mysqli_query($conn, $query);
    return $result;
}

function obtenerTodasLascanton()
{
    include("admin/conexion.php");
    $query = "SELECT `nombre_canton` FROM canton Where id_provincia = ''";
    $result = mysqli_query($conn, $query);
    return $result;

}

function obtenerTodasLasdistrito()
{
    include("admin/conexion.php");
    $query = "SELECT * FROM distrito";
    $result = mysqli_query($conn, $query);
    return $result;
}

function obtenerTodosLosTipos()
{
    include("admin/conexion.php");
    $query = "SELECT * FROM tipos";
    $result = mysqli_query($conn, $query);
    return $result;
}

function cargarPropiedades($limInferior){
    include("admin/conexion.php");
    $config = obtenerConfiguracion();
    if($config['tipo_visualizacion_propiedades']=="f"){ //Visualizamos por fecha de carga
        $query = "SELECT * FROM propiedades  ORDER BY fecha_alta DESC LIMIT $limInferior,6";
        $result = mysqli_query($conn, $query);
        return $result;
    } else {//visualizamos las primeras prop. de forma personalizada
        $query = "SELECT * FROM propiedades where 
                id='$config[propiedad1]' or 
                id='$config[propiedad2]' or 
                id='$config[propiedad3]' or 
                id='$config[propiedad4]' or 
                id='$config[propiedad5]' or 
                id='$config[propiedad6]'
            UNION
            SELECT * FROM propiedades where 
                id!='$config[propiedad1]' and 
                id!='$config[propiedad2]' and
                id!='$config[propiedad3]' and
                id!='$config[propiedad4]' and
                id!='$config[propiedad5]' and
                id!='$config[propiedad6]' LIMIT $limInferior,6";
        $result = mysqli_query($conn, $query);
        return $result;
    }
}

function obtenerPropiedadPorId($id_propiedad)
{
    //Obtenemos la propiedad en base al id que recibimos por GET
    include("admin/conexion.php");

    //Armamos el query para seleccionar la propiedad
    $query = "SELECT * FROM propiedades WHERE id='$id_propiedad'";

    //Ejecutamos la consulta
    $resultado_propiedad = mysqli_query($conn, $query);
    $propiedad = mysqli_fetch_assoc($resultado_propiedad);
    return $propiedad;
}

function obtenercanton($id_canton)
{
    include("admin/conexion.php");
    $query = "SELECT * FROM canton WHERE id='$id_canton'";

    //Ejecutamos la consulta
    $resultado_canton = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado_canton);
    return $row['nombre_canton'];
}

function obtenerprovincia($id_provincia)
{
    include("admin/conexion.php");
    $query = "SELECT * FROM provincia WHERE id='$id_provincia'";

    //Ejecutamos la consulta
    $resultado_provincia = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado_provincia);
    return $row['nombre_provincia'];
}

function obtenerFotosGaleria($id_propiedad)
{
    include("admin/conexion.php");
    $query = "SELECT * FROM fotos WHERE id_propiedad='$id_propiedad'";

    //Ejecutamos la consulta
    $resultado_fotos = mysqli_query($conn, $query);
    return $resultado_fotos;
}

function obtenerTipo($id_tipo)
{
    include("admin/conexion.php");
    $query = "SELECT * FROM tipos WHERE id='$id_tipo'";

    //Ejecutamos la consulta
    $resultado_tipo = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado_tipo);
    return $row['nombre_tipo'];
}

function realizarBusqueda($id_canton, $id_tipo, $estado){
    include("admin/conexion.php");
    if($id_canton!=="" and $id_tipo!== "" and $estado!=="" ){
        $query = "SELECT * FROM propiedades WHERE canton='$id_canton' and tipo='$id_tipo' and estado='$estado'";
    }
    else if($id_canton!=="" and $id_tipo!== "" and $estado===""){
        $query = "SELECT * FROM propiedades WHERE canton='$id_canton' and tipo='$id_tipo'";
    }
    else if($id_tipo!== "" and $estado!=="" ){
        $query = "SELECT * FROM propiedades WHERE tipo='$id_tipo' and estado='$estado'";
    }
    else if($id_canton!=="" and $estado!=="" ){
        $query = "SELECT * FROM propiedades WHERE canton='$id_canton' and estado='$estado'";
    }
    else if($id_canton!==""){
        $query = "SELECT * FROM propiedades WHERE canton='$id_canton'";
    }
    else if($id_tipo!== ""){
        $query = "SELECT * FROM propiedades WHERE tipo='$id_tipo'";
    }
    else if($estado!=="" ){
        $query = "SELECT * FROM propiedades WHERE estado='$estado'";
    }

    //Ejecutamos la consulta
    $resultado_propiedades = mysqli_query($conn, $query);
    return $resultado_propiedades;
}
