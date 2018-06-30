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
    



    echo '  <table class="table table-hover">
              <thead>
                <tr>
                    <th>Módulo</th>
                    <th>Desde</th>
                    <th>Hasta</th>
                    <th>Horas</th>
                    <th>Clases</th>
                </tr>
              </thead>
              <tbody >';
    foreach ($modulos as $modulo) {
      if ($modulo["ESTATUS"] == 1) {
        $horas_modulo = 0;
        $clases_modulo = 0;
        foreach ($clases as $clase) {
          if ($clase["id_Open_mods"]==$modulo["id"]) {
            $horas_modulo += $clase["class_time"];
            $clases_modulo += 1;
          }
        }
    echo        '<tr>
                    <td>'.$modulo["MODULO"].'</td>
                    <td>'.$modulo["FECHA_FROM"].'</td>
                    <td>'.$horas_modulo.' horas</td>
                    <td><a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$modulo["id"].'"><b>'.$clases_modulo.' clases</b></a></td>
                </tr>
                ';
        echo    '<tr id="collapse'.$modulo["id"].'" class="panel-collapse collapse" style="text-align:right">
                  <td colspan="5">';
        foreach ($clases as $clase) {
          if ($clase["id_Open_mods"]==$modulo["id"]) {
            echo    $clase["class_date"].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$clase["class_time"].' horas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a data-toggle="modal" onclick="verclase('.$clase["id_Classes"].')" href="#modal-ver_clase">ver clase</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>';  

          }
        }            
        echo    ' </td>
                </tr>';
      }
    }
        echo '</tbody>
            </table>
            ';


?>