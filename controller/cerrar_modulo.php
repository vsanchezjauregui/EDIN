<?php 
require_once '../model/conexion.php';
$conex =  new ConexionMySQL();
$resulta = $conex->conectar();
$con = $conex->usarConexion();

$id_modulo = $_GET['modulo'];
$aprobados = $_GET['aprobados'];
$perdidos = [];

//Busco los matriculados
$query_matriculados = "SELECT bridge_benef_openmods.id_beneficiary AS ID FROM bridge_benef_openmods WHERE bridge_benef_openmods.id_open_mod = $id_modulo";
$matriculados = $conex->consulta_varios($query_matriculados, $con);

//determino los perdidos
foreach ($matriculados as $matriculado) {
	$perdido = true;
    foreach ($aprobados as $aprobado) {
    	if ($matriculado["ID"]==$aprobado) {
    		$perdido = false;
    	}
    }
    if ($ganado) {
    	array_push($perdidos, $matriculado["ID"]);
    }
} 

var_dump($perdidos);





?>
