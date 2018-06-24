<?php 
require_once '../model/conexion.php';
$conex =  new ConexionMySQL();
$resulta = $conex->conectar();
$con = $conex->usarConexion();

$alianza = $_GET['id'];

$query = "DELETE FROM temp_participaciones WHERE temp_participaciones.id_Alianza = $alianza";
$eliminar = mysqli_query($con,$query);

//resgreso los datos que hay insertados
$query_participaciones = "SELECT *, (SELECT alliances.alliance_name FROM alliances WHERE alliances.id_Alliances = temp_participaciones.id_Alianza) as ALIANZA FROM temp_participaciones";
$temp_participaciones = $conex->consulta_varios($query_participaciones, $con);

if (count($temp_participaciones)>0) {
    foreach ($temp_participaciones as $temp_participacion) {
        echo "<li id='alianza_".$temp_participacion["id_Alianza"]."' value='".$temp_participacion["ALIANZA"]."'><span class='text'>".$temp_participacion["ALIANZA"]."</span><div class='tools'><i class='fa fa-eye' data-toggle='modal' href='#modal-ver_cooperacion'></i><i onclick='eliminar(".$temp_participacion["id_Alianza"].")' class='fa fa-trash-o'></i></div></li>";
    }
} 

?>