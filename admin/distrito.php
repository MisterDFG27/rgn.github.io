<?php

include("conexion.php");
$canton = $_GET['c'];
echo 

//Armamos el query para seleccionar las canton
$query = "SELECT * FROM distrito WHERE id_canton='$canton'";

//Ejecutamos la consulta
$resultado_distrito = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($resultado_distrito)){
    echo '<option value="'.$row['id'].'">';
    echo $row['nombre_distrito'];
    echo '</option>';
}

?>