<?php 
require_once '../model/conexion.php';
$conex =  new ConexionMySQL();
$resulta = $conex->conectar();
$query = "SELECT beneficiaries.beneficiary_name, beneficiaries.beneficiary_last_name, beneficiaries.id_Beneficiaries FROM beneficiaries ORDER BY beneficiaries.beneficiary_name ASC;";
$con = $conex->usarConexion();
$registro = $conex->consulta_varios($query, $con);
$beneficiarios=[];
$beneMatriculados=[];

if(!empty($_GET['seleccionados'])) {
    foreach($_GET['seleccionados'] as $check) { 
	    
	    foreach ($registro as $row) {
	    	if ($row["id_Beneficiaries"] == $check) {
	    		array_push($beneMatriculados, array($check, $row["beneficiary_name"].' '.$row["beneficiary_last_name"]));
	    	}
	    }
    }
//    print("<pre>");
//    var_dump($beneMatriculados);
//    print("</pre><br><br>");

 	$cadena = "";
    for ($i=0 ; $i < count($beneMatriculados) ; $i++ ) { 
	    $cadena .=  "<li id_benef=".$beneMatriculados[$i][0].">".$beneMatriculados[$i][1]."</li>";
    }
}
if (!empty($cadena)) {
	
	echo $cadena;
}else{
	 echo 'Para marticular beneficiarios, haga click en el botón "Agregar beneficiario"';
}

?>