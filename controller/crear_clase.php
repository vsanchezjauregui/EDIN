<?php 
require_once '../model/conexion.php';
$conex =  new ConexionMySQL();
$resulta = $conex->conectar();
$con = $conex->usarConexion();


//////////////////////////////////////////////////////////////////////
////////// 													//////////
//////////			TRAIGO LOS VALORES DE CLASE 			//////////
////////// 													//////////
//////////////////////////////////////////////////////////////////////
$modulo = $_POST['modulo'];
if ($modulo == 0) {
	header('Location: ../view/registrar_clase.php?variable=1');
}else{
	if (!isset($_POST['matriculados'])) {
		header('Location: ../view/registrar_clase.php?variable=2');
	}else{
		$fecha = substr($_POST['datepicker'], 6)."-".substr($_POST['datepicker'], 0,2)."-".substr($_POST['datepicker'], 3,2);
		$horas = $_POST["horas"];

		//defino los valores para insertar en la clase 
		$campos_clase = "classes.id_Open_mods, classes.class_date, classes.class_time";
		$valores_clase = "$modulo, '$fecha', $horas";
		if (isset($_POST["observaciones"])) {
			$observaciones = $_POST["observaciones"];
			$campos_clase .= ", classes.class_observations";
			$valores_clase .= ", '$observaciones'";
		}

		//Creo la clase
		$query_insertar = "INSERT INTO classes ($campos_clase) VALUES ($valores_clase)"; 
		echo $query_insertar."<br><br>";
		$insertar = mysqli_query($con,$query_insertar);
		$query_buscar_id = "SELECT MAX(classes.id_Classes) as id_clase FROM classes";
		echo $query_buscar_id."<br><br>";
		$id_clase = $conex->consultaunica($query_buscar_id, $con);

		//////////////////////////////////////////////////////////////////////
		////////// 													//////////
		//////////				TRAIGO LOS ALUMNOS		 			//////////
		////////// 													//////////
		//////////////////////////////////////////////////////////////////////

		$alumnos = $_POST['matriculados'];
		$query_insertar_alumnos = "INSERT INTO bridge_class_benef (bridge_class_benef.id_Beneficiaries, bridge_class_benef.id_classes) VALUES ";
		foreach ($alumnos as $alumno) {
			$query_insertar_alumnos .= "($alumno, $id_clase),";
		}
		$query_insertar_alumnos = substr($query_insertar_alumnos,0,-1);
		echo $query_insertar_alumnos."<br><br>";
		$insertar = mysqli_query($con,$query_insertar_alumnos);

		//////////////////////////////////////////////////////////////////////
		////////// 													//////////
		//////////		SI HAY PARTICIPACIONES, LAS MIGRO		 	//////////
		////////// 													//////////
		//////////////////////////////////////////////////////////////////////

		$query_buscar_participaciones = "SHOW TABLES LIKE 'temp_participaciones'";
		$hayparti = $conex->consultaunica($query_buscar_participaciones, $con);
		if (!is_null($hayparti)) {
			$query_participaciones = "SELECT * FROM temp_participaciones";
			$participaciones = $conex->consulta_varios($query_participaciones, $con);
			$query_insertar_participaciones = "INSERT into bridge_class_alliance (bridge_class_alliance.id_classes, bridge_class_alliance.id_alliance, bridge_class_alliance.alliance_cooperation) VALUES ";
			foreach ($participaciones as $participacion) {
				$query_insertar_participaciones .= "($id_clase, ".$participacion["id_Alianza"].",'".$participacion["descripcion"]."'),";
			}
			$query_insertar_participaciones = substr($query_insertar_participaciones,0,-1);
			echo $query_insertar_participaciones."<br><br>";
			$insertar = mysqli_query($con,$query_insertar_participacion);


			//////////////////////////////////////////////////////////////////////
			////////// 													//////////
			//////////				ELIMINO LA TABLA TEMPORAL		 	//////////
			////////// 													//////////
			//////////////////////////////////////////////////////////////////////
			$query_eliminar = "DROP TABLE temp_participaciones";
			$eliminar = mysqli_query($con,$query_eliminar);
		}
	header('Location: ../view/registrar_clase.php?variable=3');	
	}
}

?>