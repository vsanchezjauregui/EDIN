<?php 
	include ('../model/conexion.php'); //Establecer conexión BD
    /*Crea Variable que va a realizar la conexion*/
    $conex =  new ConexionMySQL();
    //Almacena el resultado de la conexion
	$resulta = $conex->conectar();
    //Si el resultado de la conexion fue positivo
	if($resulta){

        //termina la conexion
		$conex->destruir();

        echo "se pudo conectar";
	}else{
		echo "no se pudo conectar";
	}
?>