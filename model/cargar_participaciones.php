<?php 

require_once '../model/conexion.php';
$conex =  new ConexionMySQL();
$resulta = $conex->conectar();
$con = $conex->usarConexion();
$alianza = $_GET['idalianza'];

$query_institucion = "SELECT alliances.alliance_name as INSTITUCION FROM alliances WHERE alliances.id_Alliances = $alianza";
$institucion = $conex->consultaunica($query_institucion, $con);
$query_participaciones = "SELECT (SELECT classes.class_date FROM classes WHERE classes.id_Classes = bridge_class_alliance.id_classes) AS FECHA, (SELECT(SELECT (SELECT modules.module_name FROM modules WHERE modules.id_Modules = open_mods.id_Modules) FROM open_mods WHERE open_mods.id_Open_mods = classes.id_Open_mods) FROM classes WHERE classes.id_Classes = bridge_class_alliance.id_classes) as MODULO, bridge_class_alliance.id_classes as IDCLASE, bridge_class_alliance.alliance_cooperation as PARTICIPACION FROM bridge_class_alliance WHERE bridge_class_alliance.id_alliance = $alianza";
$participaciones = $conex->consulta_varios($query_participaciones, $con);
//echo sizeof($patricipaciones);

echo "	<div class='box-header'>
            <h4 class='box-title'>Participaciones de <b>".$institucion["INSTITUCION"]."</b></h4><br>
            <small class='pull-right'>Ha participado en <b>".sizeof($participaciones)."</b> clases</small>
        </div>";
if (sizeof($participaciones)==0) {
	echo "<div style='text-align:center'><h5>No se han registrado participaciones de esta institucion<h5></div>";
} else{
echo    "<div class='box-body'>
              <table class='table table-striped table-hover'>
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Módulo</th>
                  </tr>
                </thead>
                <tbody>";
	foreach ($participaciones as $participacion) {
		echo "			<tr>
		                    <td>".$participacion["FECHA"]."</td>
		                    <td>".$participacion["MODULO"]."</td>
		                    <td>
		                      <a onclick='verclase(".$participacion["IDCLASE"].")' data-toggle='modal' href='#modal-ver_clase'>
		                        ver clase
		                      </a>
		                    </td>
		                    <td>
		                      <a onclick='verparticipacion(".$participacion["IDCLASE"].",$alianza )' data-toggle='modal' href='#modal-ver_cooperacion' class='fa fa-eye'>
		                        
		                      </a>
		                    </td>
	                  	</tr>
	                  	";
	}

	echo "			</tbody>
	          	</table>";
}
echo    "</div>
        ";
?>