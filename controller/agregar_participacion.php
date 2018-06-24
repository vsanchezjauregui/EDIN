<?php 
require_once '../model/conexion.php';
$conex =  new ConexionMySQL();
$resulta = $conex->conectar();
$con = $conex->usarConexion();

$alianza = $_GET['alianza'];
$participacion	= $_GET['participacion'];


//creo la tabla temporal is es que fuera necesaria.
$query = "CREATE TABLE IF NOT EXISTS  temp_participaciones (id_temp_participaciones int(10) PRIMARY KEY AUTO_INCREMENT, id_Alianza int(10), descripcion varchar(500))";
$crear = mysqli_query($con,$query);

//inserto los datos necesarios
$query_insertar = "INSERT INTO temp_participaciones (temp_participaciones.id_Alianza, temp_participaciones.descripcion) VALUES (".$alianza.", '".$participacion."')"; 
$insertar = mysqli_query($con,$query_insertar);

//resgreso los datos que hay insertados
$query_participaciones = "SELECT *, (SELECT alliances.alliance_name FROM alliances WHERE alliances.id_Alliances = temp_participaciones.id_Alianza) as ALIANZA FROM temp_participaciones";
$temp_participaciones = $conex->consulta_varios($query_participaciones, $con);

if (count($temp_participaciones)>0) {
    foreach ($temp_participaciones as $temp_participacion) {
        echo "<li id='alianza_".$temp_participacion["id_Alianza"]."' value='".$temp_participacion["ALIANZA"]."'><span class='text'>".$temp_participacion["ALIANZA"]."</span><div class='tools'><i class='fa fa-eye' data-toggle='modal' onclick='participacion(".$temp_participacion["id_Alianza"].")' href='#modal-ver_cooperacion'></i><i onclick='eliminar(".$temp_participacion["id_Alianza"].")' class='fa fa-trash-o'></i></div></li>";
    }
}   

?>