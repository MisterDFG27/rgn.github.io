<?php
//datos del servidor
$server		="localhost";
$username	="u356199086_admin";
$password	="e3MCh6jmK/D";
$bd			="u356199086_bdrgn";

//creamos una conexión
$conn = mysqli_connect($server, $username, $password, $bd);

//Chequeamos la conexión
if(!$conn){
	die("Conexión fallida:" . mysqli_connect_error());
}

//Chequeamos la conexión
if(!$conn){
	die("Conexión fallida:" . mysqli_connect_error());
}
?>