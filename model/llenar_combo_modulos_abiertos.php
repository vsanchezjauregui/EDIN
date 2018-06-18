<?php
    include ('../model/conexion.php');
    $tecnico = $_GET["idtecnico"];

    //Creo variable que va a hacer la conexion
    $conex =  new ConexionMySQL();

    //Intento conectar
    $resulta = $conex->conectar();

    //atrapo la conexion
    $con = $conex->usarConexion();

    //Si conecto
    if ($resulta) {
        //Pregunto el valor que evio el primer combo
        
                $query = "SELECT open_mods.id_Open_mods, (SELECT modules.module_name FROM modules WHERE modules.id_Modules = open_mods.id_Modules) as module_name, (SELECT (SELECT technician.id_Technician FROM technician WHERE technician.id_Technician = modules.id_Technitian) FROM modules WHERE modules.id_Modules = open_mods.id_Modules) as tecnico FROM open_mods WHERE open_mods.open_mod_estatus = 1;";
                //Ejecuto la consulta
                $resultado = mysqli_query($con, $query);
                //Inicio la cadena
                $cadena='<option value="0" disable></option>';
                //Recorro el arreglo de respuesta
                while ($row = $resultado->fetch_array()) {
                    if ($row["tecnico"]==$tecnico) {
                        $cadena .= '<option value="' . $row["id_Open_mods"] . '">' . $row["module_name"] . '</option>';
                    }
                } 
                echo $cadena;
                $conex->destruir();     
    }

