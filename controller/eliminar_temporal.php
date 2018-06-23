<?php 
require_once '../model/conexion.php';
$conex =  new ConexionMySQL();
$resulta = $conex->conectar();
$con = $conex->usarConexion();

//creo el query para eliminar la tabla.
$query = "DROP TABLE temp_participaciones";
$eliminar = mysqli_query($con,$query);


?>