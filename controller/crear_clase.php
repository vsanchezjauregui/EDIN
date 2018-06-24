<?php 
require_once '../model/conexion.php';
$conex =  new ConexionMySQL();
$resulta = $conex->conectar();
$con = $conex->usarConexion();
//Variable para devolver error o no
$error = 0;

//////////////////////////////////////////////////////////////////////
////////// 													//////////
//////////			TRAIGO LOS VALORES DE CLASE 			//////////
////////// 													//////////
//////////////////////////////////////////////////////////////////////
$modulo = $_GET['modulo'];
$alumnos = $_GET['alumnos'];
$fecha = substr($_GET['fecha'], 6)."-".substr($_GET['fecha'], 0,2)."-".substr($_GET['fecha'], 3,2);
$horas = $_GET['horas'];
$observaciones = $_POST["observaciones"];
//defino los valores para insertar en la clase 
$campos_clase = "classes.id_Open_mods, classes.class_date, classes.class_time, classes.class_observations";
$valores_clase = "$modulo, '$fecha', $horas, '$observaciones'";

//Creo la clase
$query_insertar = "INSERT INTO classes ($campos_clase) VALUES ($valores_clase)"; 
//echo $query_insertar."<br><br>";
$insertar = mysqli_query($con,$query_insertar);
//Busco el id de la clase que acabo de crear
$query_buscar_id = "SELECT MAX(classes.id_Classes) as id_clase FROM classes";
//echo $query_buscar_id."<br><br>";
$id_clase = $conex->consultaunica($query_buscar_id, $con);
//Verifico si se creo correctamente la clase
if ($insertar){
//Si se inserto correctamente, continuo con el resto. 
	
	//////////////////////////////////////////////////////////////////////
	////////// 													//////////
	//////////				TRAIGO LOS ALUMNOS		 			//////////
	////////// 													//////////
	//////////////////////////////////////////////////////////////////////

	//Inserto los alumnos asistentes en el puente
	$query_insertar_alumnos = "INSERT INTO bridge_class_benef (bridge_class_benef.id_Beneficiaries, bridge_class_benef.id_classes) VALUES ";
	foreach ($alumnos as $alumno) {
		$query_insertar_alumnos .= "($alumno, $id_clase),";
	}
	$query_insertar_alumnos = substr($query_insertar_alumnos,0,-1);
	//echo $query_insertar_alumnos."<br><br>";
	$insertar = mysqli_query($con,$query_insertar_alumnos);
	
	if (!$insertar) {
		$error = 2
	}

	//////////////////////////////////////////////////////////////////////
	////////// 													//////////
	//////////		SI HAY PARTICIPACIONES, LAS MIGRO		 	//////////
	////////// 													//////////
	//////////////////////////////////////////////////////////////////////

	//averiguo si hay participaciones
	$query_buscar_participaciones = "SHOW TABLES LIKE 'temp_participaciones'";
	$hayparti = $conex->consultaunica($query_buscar_participaciones, $con);

	if (!is_null($hayparti)) {
		//si hay participaciones
		$query_participaciones = "SELECT * FROM temp_participaciones";
		$participaciones = $conex->consulta_varios($query_participaciones, $con);
		$query_insertar_participaciones = "INSERT into bridge_class_alliance (bridge_class_alliance.id_classes, bridge_class_alliance.id_alliance, bridge_class_alliance.alliance_cooperation) VALUES ";
		foreach ($participaciones as $participacion) {
			$query_insertar_participaciones .= "($id_clase, ".$participacion["id_Alianza"].",'".$participacion["descripcion"]."'),";
		}
		//inserto las participaciones en la tabla correspondiente
		$query_insertar_participaciones = substr($query_insertar_participaciones,0,-1);
		//echo $query_insertar_participaciones."<br><br>";
		$insertar = mysqli_query($con,$query_insertar_participacion);
		
		if (!$insertar) {
			$error = 3
		}

		//////////////////////////////////////////////////////////////////////
		////////// 													//////////
		//////////				ELIMINO LA TABLA TEMPORAL		 	//////////
		////////// 													//////////
		//////////////////////////////////////////////////////////////////////
		$query_eliminar = "DROP TABLE temp_participaciones";
		$eliminar = mysqli_query($con,$query_eliminar);
	}
} else {
	$error = 1;
}
if ($error > 1) {
	$query_deshacer = "DELETE FROM classes WHERE classes.id_classes = $id_clase";
	$eliminar = mysqli_query($con,$query_eliminar);
}
switch ($error) {
    case 0:
        echo "0=Se ha creado la clase";
        break;
    case 1:
        echo "1=Ha ocurrido un error cuando se creaba la clase, por favor intente de nuevo";
        break;
    case 2:
        echo "2=Ha ocurrido un error cuando se insertaban los beneficiarios asistentes. Por favor intente de nuevo";
        break;
    case 3:
        echo "3=Ha ocurrido un error cuando se insertaban las participaciones. Por favor intente de nuevo";
        break;
}






?>
