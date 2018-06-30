<?php 
require_once '../model/conexion.php';
$conex =  new ConexionMySQL();
$resulta = $conex->conectar();
$con = $conex->usarConexion();

$clase = $_GET['clase'];
$alianza = $_GET['id'];



$query = "SELECT bridge_class_alliance.alliance_cooperation AS PARTICIPACION, (SELECT alliances.alliance_name FROM alliances WHERE alliances.id_Alliances = bridge_class_alliance.id_alliance) AS ALIANZA FROM bridge_class_alliance WHERE (bridge_class_alliance.id_alliance = $alianza) AND (bridge_class_alliance.id_classes = $clase)";
$participacion = $conex->consultaunica($query, $con);


    echo '	
	        <div class="modal-dialog">
          		<div class="modal-content" >
		    		<div class="modal-header">
		    			<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
		    			<h4 class="modal-title">'.$participacion["ALIANZA"].'</h4>
		    		</div>
		    		<div class="modal-body">
		            	<div class="box-body" style="text-align:justify;">
		                	'.$participacion["PARTICIPACION"].'
		              	</div>
		            </div>
		            <div class="modal-footer">
		              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
		            </div>
	            </div>
            <div>';

?>