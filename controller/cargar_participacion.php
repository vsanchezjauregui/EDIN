<?php 
require_once '../model/conexion.php';
$conex =  new ConexionMySQL();
$resulta = $conex->conectar();
$con = $conex->usarConexion();

$alianza = $_GET['id'];


//creo la tabla temporal is es que fuera necesaria.
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