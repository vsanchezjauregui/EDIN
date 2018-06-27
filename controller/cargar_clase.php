<?php 
require_once '../model/conexion.php';
$conex =  new ConexionMySQL();
$resulta = $conex->conectar();
$con = $conex->usarConexion();

$id_clase = $_GET['id'];

//Busco la clase
$query_clase = "SELECT (SELECT (SELECT modules.module_name FROM modules WHERE modules.id_Modules = open_mods.id_Modules) FROM open_mods WHERE open_mods.id_Open_mods = classes.id_Open_mods) as MODULO, classes.class_date as FECHA, classes.class_time as DURACION, classes.class_observations as OBSERVACION FROM classes WHERE classes.id_Classes = $id_clase";
$clase = $conex->consultaunica($query_clase, $con);

$query_alumnos = "SELECT (SELECT beneficiaries.beneficiary_name FROM beneficiaries WHERE beneficiaries.id_Beneficiaries = bridge_class_benef.id_Beneficiaries) AS NOMBRE, (SELECT beneficiaries.beneficiary_last_name FROM beneficiaries WHERE beneficiaries.id_Beneficiaries = bridge_class_benef.id_Beneficiaries) AS APELLIDO FROM bridge_class_benef WHERE bridge_class_benef.id_classes = $id_clase";
$alumnos = $conex->consulta_varios($query_alumnos, $con);

$query_alianzas = "SELECT bridge_class_alliance.id_bridge_class_alliance as ID, bridge_class_alliance.alliance_cooperation as COOPERACION,(SELECT alliances.alliance_name FROM alliances WHERE alliances.id_Alliances = bridge_class_alliance.id_alliance) AS ALIANZA FROM bridge_class_alliance WHERE bridge_class_alliance.id_classes = $id_clase";
$alianzas = $conex->consulta_varios($query_alianzas, $con);

echo '
<div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Clase Impartida</h4>
            </div>
            <div class="modal-body">
              <div class="box-body" style="text-align:justify;">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Técnico</label><br>
                    Técnico en Administración de Empresas
                  </div>
                  <div class="form-group">
                    <label>Módulo</label><br>';
    echo $clase["MODULO"];

    echo          '</div>
                  <div class="form-group">
                    <label>Fecha en que se impartió</label><br>';
    echo $clase["FECHA"];
    echo          '</div>
                  <div class="form-group">
                    <label>Horas impartidas</label><br>';
    echo $clase["DURACION"].' horas';
    echo          '</div>
                  <div class="form-group">
                    <label>Observaciones</label><br>';
    echo $clase["OBSERVACION"];
    echo          '</div>
                </div>
                <div class="col-sm-6">
                  <div class="box box-solid box-info" id="matriculados">
                    <div class="box-header">
                    <h4 class="box-title">Beneficiarios asistentes</h4>
                    </div>
                    <div class="box-body">
                      <table class="table table-striped table-hover">
                        <tbody>';
foreach($alumnos as $alumno){
    echo '                  <tr>
                                <td>';
    echo $alumno["NOMBRE"]." ".$alumno["APELLIDO"];
    echo                        '</td>
                            </tr>';
}                        
    echo                '</tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="box box-solid box-info" id="matriculados">
                    <div class="box-header">
                      <h4 class="box-title">Instituciones participantes</h4>
                    </div>

                    <div class="box-body">
                      <table class="table table-striped table-hover">
                        <tbody>';
    foreach ($alianzas as $alianza){
        echo                    '<tr><td>'.$alianza["ALIANZA"].'<a data-toggle="collapse" data-parent="#accordion" href="#collapse_part'.$alianza["ID"].'" class="pull-right fa fa-eye"></a></td></tr>';
        echo                    '<tr id="collapse_part'.$alianza["ID"].'" class="panel-collapse collapse col-sm-12"><td>'.$alianza["COOPERACION"].'</td></tr>';
    }                        
        echo            '</tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>';




?>
