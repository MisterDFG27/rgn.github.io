<?php

include("conexion.php");
$provincia = $_GET['c'];
echo 

//Armamos el query para seleccionar las canton
$query = "SELECT * FROM canton WHERE id_provincia='$provincia'";

//Ejecutamos la consulta
$resultado_canton = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($resultado_canton)){
    echo '<option value="'.$row['id'].'">';
    echo $row['nombre_canton'];
    echo '</option>';
}

?>