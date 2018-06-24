<?php 
require_once '../model/conexion.php';
$conex =  new ConexionMySQL();
$resulta = $conex->conectar();
$con = $conex->usarConexion();

$clase = $_GET['id'];


$query_clase = "SELECT (SELECT (SELECT modules.module_name FROM modules WHERE modules.id_Modules = open_mods.id_Modules) FROM open_mods WHERE open_mods.id_Open_mods = classes.id_Open_mods) as MODULO, classes.class_date as FECHA, classes.class_time as DURACION, classes.class_observations as OBSERVACION FROM classes WHERE classes.id_Classes = $clase";


$query = "SELECT *,(SELECT alliances.alliance_name FROM alliances WHERE alliances.id_Alliances = temp_participaciones.id_Alianza) as ALIANZA FROM temp_participaciones WHERE temp_participaciones.id_Alianza = $alianza";
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
		                	'.$participacion["descripcion"].'
		              	</div>
		            </div>
		            <div class="modal-footer">
		              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
		            </div>
	            </div>
            <div>';

/*

              
                
              
            
            
*/   

?>