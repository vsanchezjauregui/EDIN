<?php 
require_once '../model/conexion.php';
$conex =  new ConexionMySQL();
$resulta = $conex->conectar();
$con = $conex->usarConexion();

$id_modulo = $_GET['modulo'];

//Busco los matriculados

$query_matriculados = "SELECT bridge_benef_openmods.id_beneficiary AS ID, (SELECT beneficiaries.beneficiary_name FROM beneficiaries WHERE beneficiaries.id_Beneficiaries = bridge_benef_openmods.id_beneficiary) as NOMBRE, (SELECT beneficiaries.beneficiary_last_name FROM beneficiaries WHERE beneficiaries.id_Beneficiaries = bridge_benef_openmods.id_beneficiary) AS APELLIDO FROM bridge_benef_openmods WHERE bridge_benef_openmods.id_open_mod = $id_modulo";
$matriculados = $conex->consulta_varios($query_matriculados, $con);
//var_dump($matriculados);
//Los imprimo

foreach ($matriculados as $matriculado) {
    echo '<tr><td><input id="matriculados" name="aprobados[]" type="checkbox" class="flat-red" value="'.$matriculado["ID"].'"> '.$matriculado["NOMBRE"].' '.$matriculado["APELLIDO"].'</td></tr>';
} 





?>
