<?php 

require_once '../model/conexion.php';
$conex =  new ConexionMySQL();
$resulta = $conex->conectar();
$query = "SELECT COUNT(beneficiaries.id_Beneficiaries) as CANTIDAD FROM beneficiaries";
$con = $conex->usarConexion();
$registro = $conex->consultaunica($query, $con);

echo $registro["CANTIDAD"];

?>