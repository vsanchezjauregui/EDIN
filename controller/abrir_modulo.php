<?php 
require_once '../model/conexion.php';
$conex =  new ConexionMySQL();
$resulta = $conex->conectar();
$query = "SELECT beneficiaries.beneficiary_name, beneficiaries.beneficiary_last_name, beneficiaries.id_Beneficiaries FROM beneficiaries ORDER BY beneficiaries.beneficiary_name ASC;";
$con = $conex->usarConexion();
$registro = $conex->consulta_varios($query, $con);
$beneficiarios=[];
$beneMatriculados=[];

$tecnico = $_GET['tecnico'];
$modulo	= $_GET['modulo'];
$valor = $_GET['valorModulo'];
$hoy = new DateTime();
$fecha	= $hoy->format("Y-m-d");

if(!empty($_GET['seleccionados'])) {
    foreach($_GET['seleccionados'] as $check) { 
	    
	    foreach ($registro as $row) {
	    	if ($row["id_Beneficiaries"] == $check) {
	    		array_push($beneMatriculados, array($check, $row["beneficiary_name"].' '.$row["beneficiary_last_name"]));
	    	}
	    }
    }

    $query_crear_mod = "INSERT INTO open_mods (open_mods.id_Modules, open_mods.open_mod_date_from, open_mods.open_mod_estatus, open_mods.open_mod_value) VALUES ($modulo, '$fecha', 1, $valor);";
 	$query_buscar_id = "SELECT MAX(open_mods.id_Open_mods) as id_Open_mods FROM open_mods";
 	$crear_open_mod = mysqli_query($con,$query_crear_mod);
 	$id_mod = $conex->consultaunica($query_buscar_id, $con);
 	$query_matricular = "INSERT INTO bridge_benef_openmods (bridge_benef_openmods.id_beneficiary, bridge_benef_openmods.id_open_mod, bridge_benef_openmods.status_benef) VALUES ";

    for ($i=0 ; $i < count($beneMatriculados) ; $i++ ) { 
	    $query_matricular .= "(".$beneMatriculados[$i][0].", ".$id_mod["id_Open_mods"].", 'cursando'),";
    }
    $query_matricular = trim($query_matricular, ',');

    $martricular_alumnos = mysqli_query($con,$query_matricular);

    echo var_dump($martricular_alumnos);
}else{	
	echo 'Debe seleccionar al menos un beneficiario'; 

}

?>