<?php
    include ('../model/conexion.php');

    //Creo variable que va a hacer la conexion
    $conex =  new ConexionMySQL();

    //Intento conectar
    $resulta = $conex->conectar();

    //atrapo la conexion
    $con = $conex->usarConexion();

    //Si conecto
    if ($resulta) {
                $query = "SELECT technician.technician_name, technician.id_Technician  from technician ORDER BY technician.technician_name  ASC";
                //Ejecuto la consulta
                $resultado = mysqli_query($con, $query);
                //Inicio la cadena
                $cadena="";
                //Recorro el arreglo de respuesta
                while ($row = $resultado->fetch_array()) { 
                    $cadena .= '<option value="' . $row['id_Technician'] . '">' . $row['technician_name'] . '</option>';
                } 
                echo $cadena;
                $conex->destruir();     
    }
    
