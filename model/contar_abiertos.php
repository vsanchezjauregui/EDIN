<?php 

require_once '../model/conexion.php';
$conex =  new ConexionMySQL();
$resulta = $conex->conectar();
$query = "SELECT COUNT(open_mods.id_Open_mods) as CANTIDAD FROM open_mods";
$con = $conex->usarConexion();
$registro = $conex->consultaunica($query, $con);

echo $registro["CANTIDAD"];

?>