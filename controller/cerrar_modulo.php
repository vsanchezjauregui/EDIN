<?php 
require_once '../model/conexion.php';
$conex =  new ConexionMySQL();
$resulta = $conex->conectar();
$con = $conex->usarConexion();

$id_modulo = $_GET['modulo'];
if (isset($_GET['aprobados'])){
    $aprobados = $_GET['aprobados'];    
} else {
    $aprobados = [];
}

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
    if ($perdido) {
    	array_push($perdidos, $matriculado["ID"]);
    }
} 

//Determino la fecha en que se esta cerrando el modulo
$hoy = new DateTime();
$hoy =  $hoy->format('Y-m-d');


//Cierro el modulo
$query_cerrar_modulo = "UPDATE open_mods set open_mods.open_mod_estatus = 0, open_mods.open_mode_date_to = '$hoy' WHERE open_mods.id_Open_mods = $id_modulo";
$cerrar_modulo = mysqli_query($con,$query_cerrar_modulo);

//Cambio el estatus a los aprobados
if (sizeof($aprobados)>0){
    foreach($aprobados as $aprobado){
        $query_ganado = "UPDATE bridge_benef_openmods SET bridge_benef_openmods.status_benef = 'ganado' WHERE bridge_benef_openmods.id_beneficiary = $aprobado AND bridge_benef_openmods.id_open_mod = $id_modulo;";
        $cambiar_estatus_alumno = mysqli_query($con,$query_ganado);
    }
}
if (sizeof($perdidos)>0){
    foreach($perdidos as $perdido){
        $query_perdido = "UPDATE bridge_benef_openmods SET bridge_benef_openmods.status_benef = 'perdido' WHERE bridge_benef_openmods.id_beneficiary = $perdido AND bridge_benef_openmods.id_open_mod = $id_modulo;";
        $cambiar_estatus_alumno = mysqli_query($con,$query_perdido);
    }
}

echo "Se ha cerrado con exito"


?>
