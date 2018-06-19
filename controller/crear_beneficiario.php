<?php  
    require_once '../model/conexion.php';
    $conex =  new ConexionMySQL();
    $resulta = $conex->conectar();
    $con = $conex->usarConexion();

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellidos"];
    $cedula = $_POST["cedula"][0].substr($_POST["cedula"],2,4).substr($_POST["cedula"],7,4);
    $estadoCivil = $_POST["estadoCivil"];
    $hijos = $_POST["hijos"];
    $indigencia = $_POST["indigencia"];
    $nacionalidad = strtolower($_POST["nacionalidad"]);
    $fecha_nacimiento = substr($_POST["fecha_nacimiento"], 6)."-".substr($_POST["fecha_nacimiento"], 3,2)."-".substr($_POST["fecha_nacimiento"], 0,2);
    $genero = strtolower($_POST["genero"]);
    $profesion = $_POST["profesion"];
    $ultimoTitulo = $_POST["ultimoTitulo"];
    $centroEstudios = $_POST["centroEstudios"];
    $anoCulminacion = $_POST["anoCulminacion"];

    $query_direcion = 'SELECT distrito.nombre as DISTRITO, (SELECT canton.nombre FROM canton WHERE canton.numeroCanton = '.$_POST["canton"].') as CANTON, (SELECT provincia.nombre FROM provincia WHERE provincia.numeroProvincia = '.$_POST["provincia"].') as PROVINCIA from distrito WHERE distrito.numeroDistrito = '.$_POST["distrito"];
    $direcion = $conex->consultaunica($query_direcion, $con);

    $provincia = $direcion["PROVINCIA"];
    $canton = $direcion["CANTON"];
    $distrito = $direcion["DISTRITO"];
    $senas = $_POST["senas"];
    $telCasa = substr($_POST["telCasa"],0,4).substr($_POST["telCasa"],5,4);
    $telOfinina = substr($_POST["telOfinina"],0,4).substr($_POST["telOfinina"],5,4);
    $telCelular= substr($_POST["telCelular"],0,4).substr($_POST["telCelular"],5,4);
    $correo = $_POST["correo"];
    $enfermedades = $_POST["enfermedades"];
    $medicamentos = $_POST["medicamentos"];
    

    $campos = '	`beneficiary_name`,
    			`beneficiary_last_name`,
    			`beneficiary_id_num`,
    			`beneficiary_nationality`,
    			`beneficiary_birth`,
    			`beneficiary_gender`,
    			`beneficiary_province`,
    			`beneficiary_canton`,
    			`beneficiary_district`';


    $valores = '"'.$nombre.'","'.$apellido.'",'.$cedula.',"'.$nacionalidad.'","'.$fecha_nacimiento.'","'.$genero.'","'.$provincia.'","'.$canton.'","'.$distrito.'"';

	$campos .= ", `beneficiary_marital_status`";
    if (!empty($estadoCivil)) {
    	$valores .= ', "'.$estadoCivil.'"';
    }else{
    	$valores .= ', "soltero"';
    }

	$campos .= ", `beneficiary_sons`";
    if (empty($hijos)) {
    	$valores .= ', 0';
    } else {
    	$valores .= ', '.$hijos;	
    }

    $campos .= ", `beneficiary_condition_years`";
    if (empty($indigencia)) {
    	$valores .= ', 0';
    }else{
    	$valores .= ', '.$indigencia;	
    }

    if (!empty($profesion)) {
    	$campos .= ", `beneficiary_profesion`";
    	$valores .= ', "'.$profesion.'"';
    }

    if (!empty($senas)) {
    	$campos .= ", `beneficiary_addres`";
    	$valores .= ', "'.$senas.'"';
    }

    if (!empty($telCasa)) {
    	$campos .= ", `beneficiary_house_phone`";
    	$valores .= ', '.$telCasa;
    }

    if (!empty($telOfinina)) {
    	$campos .= ", `beneficiary_office_phone`";
    	$valores .= ', '.$telOficina;
    }

    if (!empty($telCelular)) {
    	$campos .= ", `beneficiary_cell_phone`";
    	$valores .= ', '.$telCelular;
    }

    if (!empty($correo)) {
    	$campos .= ", `beneficiary_mail`";
    	$valores .= ', "'.$correo.'"';
    }

    if (!empty($ultimoTitulo)) {
    	$campos .= ", `beneficiary_degree`";
    	$valores .= ', "'.$ultimoTitulo.'"';
    }

    if (!empty($centroEstudios)) {
    	$campos .= ", `beneficiary_study_center`";
    	$valores .= ', "'.$centroEstudios.'"';
    }

    if (!empty($anoCulminacion)) {
    	$campos .= ", `beeficiary_degree_year`";
    	$valores .= ', '.$anoCulminacion;
    }

    if (!empty($enfermedades)) {
    	$campos .= ", `beneificary_illness`";
    	$valores .= ', "'.$enfermedades.'"';
    }

    if (!empty($medicamentos)) {
    	$campos .= ", `beneficiary_meds`";
    	$valores .= ', "'.$medicamentos.'"';
    }

    $query = "INSERT INTO `beneficiaries` (".$campos.") VALUES (".$valores.")";

    echo $query;
    //$insertar = mysqli_query($con,$query);

    /*if (!$insertar) { 
		header('Location: ../view/registrar_beneficiario.php?variable=false');
	} else{
		header('Location: ../view/registrar_beneficiario.php?variable=true');
	}*/

    $conex->destruir();
?>
