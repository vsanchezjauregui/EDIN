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
        //Pregunto el valor que evio el primer combo
                
                $query = "SELECT technician.technician_name, technician.id_Technician  from technician";
                //Ejecuto la consulta
                $resultado = mysqli_query($con, $query);
                //Inicio la cadena
                $cadena="";
                //Recorro el arreglo de respuesta
                while ($row = $resultado->fetch_array()) {
                    //<a href=""><span class="text">".$row["technician_name"]."</span></a>
                    $cadena .= '<li><a onclick="cargarmodulos('.$row["id_Technician"].')" id="tecnico'.$row["id_Technician"].'" style="cursor:poniter"><span class="text" style="cursor: pointer;">'.$row["technician_name"].'</span></a></li>';
                } 
                echo $cadena;
                $conex->destruir();     
    }

