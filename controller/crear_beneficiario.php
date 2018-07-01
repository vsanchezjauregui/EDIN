<?php  
    require_once '../model/conexion.php';
    $conex =  new ConexionMySQL();
    $resulta = $conex->conectar();
    $con = $conex->usarConexion();

    $nombre = $_GET["nombre"];
    $apellido = $_GET["apellidos"];
    $cedula = $_GET["cedula"][0].substr($_GET["cedula"],2,4).substr($_GET["cedula"],7,4);
    $estadoCivil = $_GET["estadoCivil"];
    $hijos = $_GET["hijos"];
    $indigencia = $_GET["indigencia"];
    $nacionalidad = strtolower($_GET["nacionalidad"]);
    $fecha_nacimiento = substr($_GET["fecha_nacimiento"], 6)."-".substr($_GET["fecha_nacimiento"], 3,2)."-".substr($_GET["fecha_nacimiento"], 0,2);
    $genero = strtolower($_GET["genero"]);
    $profesion = $_GET["profesion"];
    $profesion_recortada = str_replace(' ', '', $profesion);
    $ultimoTitulo = $_GET["ultimoTitulo"];
    $centroEstudios = $_GET["centroEstudios"];
    $anoCulminacion = $_GET["anoCulminacion"];

    $query_direcion = 'SELECT distrito.nombre as DISTRITO, (SELECT canton.nombre FROM canton WHERE canton.numeroCanton = '.$_GET["canton"].') as CANTON, (SELECT provincia.nombre FROM provincia WHERE provincia.numeroProvincia = '.$_GET["provincia"].') as PROVINCIA from distrito WHERE distrito.numeroDistrito = '.$_GET["distrito"];
    $direcion = $conex->consultaunica($query_direcion, $con);

    $provincia = $direcion["PROVINCIA"];
    $canton = $direcion["CANTON"];
    $distrito = $direcion["DISTRITO"];
    $senas = $_GET["senas"];
    if (isset($_GET["telCasa"])){
        $telCasa = substr($_GET["telCasa"],0,4).substr($_GET["telCasa"],5,4);
    }
    if (isset($_GET["telOfinina"])){
        $telOfinina = substr($_GET["telOfinina"],0,4).substr($_GET["telOfinina"],5,4);
    }
    if (isset($_GET["telCelular"])){
        $telCelular= substr($_GET["telCelular"],0,4).substr($_GET["telCelular"],5,4);
    }
    $correo = $_GET["correo"];
    $enfermedades = $_GET["enfermedades"];
    $medicamentos = $_GET["medicamentos"];
    
 
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
    
    if (!empty($profesion_recortada)) {
    	$campos .= ", `beneficiary_profesion`";
    	$valores .= ', "'.$profesion.'"';
    }else{
    	$campos .= ", `beneficiary_profesion`";
    	$valores .= ', "Ninguna"';
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

    
    $insertar = mysqli_query($con,$query);
    
    echo $insertar;


    $conex->destruir();
?>
