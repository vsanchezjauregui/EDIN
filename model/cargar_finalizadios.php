<?php  
    require_once '../model/conexion.php';
    $conex =  new ConexionMySQL();
    $resulta = $conex->conectar();
    $con = $conex->usarConexion();
    $query_modulos = "SELECT open_mods.id_Open_mods as id, (SELECT modules.module_name FROM modules WHERE modules.id_Modules = open_mods.id_Modules) as MODULO, open_mods.open_mod_estatus as ESTATUS, open_mods.open_mod_value as VALOR, open_mods.open_mod_date_from as FECHA_FROM, open_mods.open_mode_date_to as FECHA_TO FROM open_mods;";
    $query_clases = "SELECT classes.id_Classes, classes.id_Open_mods, classes.class_date, classes.class_time, classes.class_observations, (SELECT (SELECT modules.module_name FROM modules WHERE modules.id_Modules = open_mods.id_Modules) FROM open_mods WHERE open_mods.id_Open_mods = classes.id_Open_mods) as MODULO FROM classes;";
    $query_finalizados = "SELECT COUNT(open_mods.id_Open_mods) as FINALIZADOS FROM open_mods WHERE open_mods.open_mod_estatus = 0";
    $query_abiertos = "SELECT COUNT(open_mods.id_Open_mods) as ABIERTOS FROM open_mods WHERE open_mods.open_mod_estatus = 1";
    $finalizados = $conex->consultaunica($query_finalizados, $con);
    $finalizados = $finalizados["FINALIZADOS"];
    $abiertos = $conex->consultaunica($query_abiertos, $con);
    $abiertos = $abiertos["ABIERTOS"];
    $modulos = $conex->consulta_varios($query_modulos, $con);
    $clases =$conex->consulta_varios($query_clases, $con);
    $conex->destruir();
    


  if ($abiertos == 0) {
    echo "No hay módulos finalizados";
  }else{
    foreach ($modulos as $modulo) {
      if ($modulo["ESTATUS"] == 0) {
        $horas_modulo = 0;
        $clases_modulo = 0;
        foreach ($clases as $clase) {
          if ($clase["id_Open_mods"]==$modulo["id"]) {
            $horas_modulo += $clase["class_time"];
            $clases_modulo += 1;
          }
        }
        echo '  <div id="'.$modulo["id"].'">
                    <div class="col-sm-4">
                        <b>'.$modulo["MODULO"].'</b>
                    </div>
                <div class="col-sm-2">
                    <b>'.$modulo["FECHA_FROM"].'</b>
                </div>
                <div class="col-sm-2">
                    <b>'.$modulo["FECHA_TO"].'</b>
                </div>
                <div class="col-sm-2">
                    <b>'.$horas_modulo.' horas</b>
                </div>
                <div class="col-sm-2">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$modulo["id"].'">
                        <b>'.$clases_modulo.' clases</b>
                    </a>
                </div>
                <div id="collapse'.$modulo["id"].'" class="panel-collapse collapse col-sm-12">';
        foreach ($clases as $clase) {
          if ($clase["id_Open_mods"]==$modulo["id"]) {
            echo '  <div class="col-sm-12">
                        <div class="col-sm-2 pull-right">
                            <a  data-toggle="modal" onclick="verclase('.$clase["id_Classes"].')" href="#modal-ver_clase">
                                ver clase
                            </a>
                        </div>
                    <div class="col-sm-2 pull-right">
                        '.$clase["class_time"].' horas
                    </div>
                    <div class="col-sm-2 pull-right">
                        '.$clase["class_date"].'
                    </div>
                </div>';
          }
        }
    echo "  </div>
        </div>";
      }
    }
  }
?>