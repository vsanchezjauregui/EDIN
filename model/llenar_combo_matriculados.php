<?php
    include ('../model/conexion.php');
    $modulo = $_GET["idmodulo"];

    //Creo variable que va a hacer la conexion
    $conex =  new ConexionMySQL();

    //Intento conectar
    $resulta = $conex->conectar();

    //atrapo la conexion
    $con = $conex->usarConexion();

    //Si conecto
    if ($resulta) {
        if ($modulo!=0) {
        $query = "SELECT bridge_benef_openmods.id_beneficiary as id_beneficiario, (SELECT beneficiaries.beneficiary_name FROM beneficiaries WHERE beneficiaries.id_Beneficiaries = bridge_benef_openmods.id_beneficiary) as nombre_beneficiario, (SELECT beneficiaries.beneficiary_last_name FROM beneficiaries WHERE beneficiaries.id_Beneficiaries = bridge_benef_openmods.id_beneficiary) as apellido_beneficiario FROM bridge_benef_openmods WHERE bridge_benef_openmods.id_open_mod = $modulo";
        //Ejecuto la consulta
        $resultado = mysqli_query($con, $query);
        //Inicio la cadena
        
        //Recorro el arreglo de respuesta
        $cadena     =   '
                            <div class="mailbox-controls">
                                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button> Seleccionar todos
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                    <tbody id="matriculados" name="matriculados">';
        while ($row = $resultado->fetch_array()) {
            $cadena .= '<tr><td><input id="matriculados" name="matriculados[]" type="checkbox" class="flat-red" value="'.$row["id_beneficiario"].'"> '.$row["nombre_beneficiario"].' '.$row["apellido_beneficiario"].'</td></tr>';
        } 
        $cadena .=                  '</tbody>
                                </table>
                            </div>
                      ';
        echo $cadena;
        }else{
            echo "<p style='text-align:center'>
                    Seleccione un Módulo
                  </p>";
        }
        $conex->destruir();     
    }

