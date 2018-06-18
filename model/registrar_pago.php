<?php
    include ('../model/conexion.php');
    $beneficiario = $_GET["idbeneficiario"];

    //Creo variable que va a hacer la conexion
    $conex =  new ConexionMySQL();

    //Intento conectar
    $resulta = $conex->conectar();

    //atrapo la conexion
    $con = $conex->usarConexion();
    //Si conecto
    if ($resulta) {

        //Pregunto el valor que evio el primer combo
        
                $query_pagos = "SELECT * FROM payments WHERE payments.id_beneficiary = $beneficiario";
                $query_matriculados = "SELECT *, (SELECT open_mods.open_mod_value FROM open_mods WHERE open_mods.id_Open_mods = bridge_benef_openmods.id_open_mod) as VALOR, (SELECT (SELECT modules.module_name FROM modules WHERE modules.id_Modules = open_mods.id_Modules) FROM open_mods WHERE open_mods.id_Open_mods = bridge_benef_openmods.id_open_mod) as modulo FROM bridge_benef_openmods WHERE bridge_benef_openmods.id_beneficiary = $beneficiario;";

                
                //Ejecuto la consulta
                $pagos = mysqli_query($con, $query_pagos);
                $matriculados =  mysqli_query($con, $query_matriculados);
                //Inicio la cadena
                $cadena='';
                
                foreach ($matriculados as $row) {
                  $pago_modulo = 0;
                  foreach ($pagos as $row2) {
                    if ($row2["id_open_mod"]==$row["id_open_mod"]) {
                      $pago_modulo += $row2["payment_value"];
                    }
                  }
                  $deuda = $row["VALOR"] - $pago_modulo;
                  if ($deuda>0) {
                    $cadena .= '<option value="' .$row["id_open_mod"].'-'.$deuda.'">' . $row["modulo"] . '</option>';
                  }
                }
                echo $cadena;
                $conex->destruir();     
    }

